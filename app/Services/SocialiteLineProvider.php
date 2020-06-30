<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Config;
use Exception;
use Log;

/**
 * Socialite LINEログイン用のサービスプロバイダー
 */
class SocialiteLineProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * アクセストークンレスポンスに含まれるIDトークンを検証するために、Social APIのエンドポイントに送信する値（配列）
     */
    protected $verifyFields = ['id_token', 'client_id', 'nonce'];

    /**
     * スコープの結合文字を%20にするためにエンコードタイプをオーバーライド
     */
    protected $encodingType = PHP_QUERY_RFC3986;

    protected $verifyIdToken = null;

    protected $verifyClientId = null;

    /**
     * nonceを利用する必要があるかどうかを示します.
     */
    protected $nonceless = false;

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = ['profile', 'openid', 'email'];

    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = " ";

    /**
     * The fields that are included in the profile.
     * プロファイルに含まれるフィールド
     * だがここでは、codeFieldsの変数として実装している。
     * この初期値はgetCodeFields()によってclient_id,redirect_uri,scope,response_type,stateに更新されます。
     * @var array
     */
    protected $fields = [];

    /**
     * 認証URLを取得.
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://access.line.me/oauth2/v2.1/authorize', $state);
    }

    /**
     * コードフィールドを取得する.
     * {@inheritdoc}
     *
     * LINEに認可を要求するには、認可URLに必須のクエリパラメータを付けてユーザーをリダイレクトします。（LINEデベロッパーより）
     * このメソッドの戻り値がユーザー ⇒ LINE認可サーバーの最初のステップです。
     */
    protected function getCodeFields($state = null)
    {
        // parentで親クラスのgetCodeFields()を使用。引数に$state(nullを許可)を渡して$fieldsに代入する。
        $fields = parent::getCodeFields($state);

        // $fieldsの連想配列に新規インデックス'nonce'を追加。
        // 値はlaravelグローバル「ヘルパ」PHP関数のStr::randomを使用して指定した長さ(40)のランダムな文字列を生成する。
        // 任意のパラメータを追加したい場合は、以下に記述する
        // ※PHPのrandom_bytes関数を使用している。
        $nonce = null;
        if ($this->usesNonce()) {
            $this->request->session()->put('nonce', $nonce = $this->getNonce());
        }
        $fields['nonce'] = $this->request->session()->get('nonce');
        // Log::info($fields['nonce']);

        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    public function user()
    {
        Log::info('LINEログインのState検証を開始します');
        if ($this->hasInvalidState()) {
            throw new InvalidStateException;
        }
        Log::info('LINEログインのState検証を終了しました');

        $response = $this->getAccessTokenResponse($this->getCode());

        $user = $this->mapUserToObject($this->getUserByToken(
            // Arr::getメソッドは指定された値を「ドット」記法で
            // 指定された値を深くネストされた配列から取得します。
            // $responseの中から'id_token'を取得して$tokenに代入する。
            $token = Arr::get($response, 'id_token')
            // );
        ));

        $user->setToken($token)
        // $responseの中から'refresh_token'を取得して$setRefreshTokenメソッドの引数に渡す。
        ->setRefreshToken(Arr::get($response, 'refresh_token'))
        // $responseの中から'expires_in'を取得して$setExpiresInメソッドの引数に渡す。
        ->setExpiresIn(Arr::get($response, 'expires_in'));

        // アクセストークンの応答で取得したIDトークンをメンバ変数にセット
        $this->setIdToken(Arr::get($response, 'id_token'));

        // 期待されるチャネルIDをメンバ変数にセット
        $client_id = env('LINE_CLIENT_ID');
        $this->setVerifyClientId($client_id);

        // Verifyレスポンスを取得 （Social APIエンドポイントにてIDトークンは検証済み）
        $verifyResponse = $this->getVerifyResultResponse();

        $verifyResponseName = $verifyResponse['name'];
        $verifyResponseEmail = $verifyResponse['email'];

        $user['name'] = $verifyResponseName;
        $user['email'] = $verifyResponseEmail;

        $veriNonce = $verifyResponse['nonce'];
        $this->request->session()->put('nonce2', $veriNonce);

        Log::info('LINEログインのNonce検証を開始します');
        if ($this->hasInvalidNonce()) {
            throw new InvalidNonceException;
        }
        Log::info('LINEログインのNonce検証を終了しました');

        Log::info('Nonce検証終了直後、return $user前のnameは' . $user['name']);
        Log::info('Nonce検証終了直後、return $user前のemailは' . $user['email']);

        return $user;
    }

    /**
     * 無効なNonce設定を持っているか確認する
     */
    protected function hasInvalidNonce()
    {
        if ($this->isNonceless()) {
            return false;
        }
        // 自身のオブジェクト$thisの->requestインスタンス経由のセッションからnonceアイテムを取得して$nonceに代入（セッションのnonceは削除される）
        Log::info('nonceを検証します');
        $userNonce = $this->request->session()->pull('nonce');

        $veriNonce = $this->request->session()->pull('nonce2');
        // Log::info($veriNonce);


        // strlen — 文字列の長さを得る
        // $nonceの文字列の長さが0より大きい、且つ、
        // 自身のオブジェクト$thisの->requestインスタンス経由のinput()を使用してユーザー入力の'nonce'にアクセスした値がセッションに保存されていた$nonceと同じ、でない場合(!付きのため)
        return ! (strlen($userNonce) > 0 && $veriNonce === $userNonce);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://api.line.me/oauth2/v2.1/token';
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return parent::getTokenFields($code) + ['grant_type' => 'authorization_code'];
    }

    /**
     * IDトークンでユーザーを取得.
     * @param string $id_token
     */
    protected function getUserByToken($id_token)
    {
        $id_token_array = explode('.', $id_token);

        // $this->id_token_infoに代入される値は、arrayメソッドで作成した配列。
        // その配列の中にはヘッダー部の配列、ペイロード部の配列を格納する。
        // 処理はbase64_decodeメソッドで暗号化された文字を復号化して、
        // JWT形式で記述された中身をjson_decodeメソッドで配列として使用できるようにしている。
        return $this->id_token_info = array(json_decode(base64_decode($id_token_array[0]), true),
                                            json_decode(base64_decode($id_token_array[1]), true),
                                            json_decode(base64_decode($id_token_array[2]), true),
                                    );
    }

    /**
     * ユーザーをオブジェクトにマップする
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)//引数$user配列の例　."iss": "https://access.line.me"
    {
        // Laravel\Socialite\Two\Userクラスの親クラス(AbstractUser)のsetRawメソッドで、
        // $userの属性（配列）をnewしたUserインスタンスにセットする。
        // ここでは全て値がnullになる。プロフィール取得時に使用すると思われる。
        // mapUserToObject()はabstractのためオーバーライドした。
        return (new User)->setRaw($user)->map([
            'id' => Arr::get($user, 'userId'),
            'name' => Arr::get($user, 'displayName'),
            'email' => Arr::get($user, 'email'),
        ]);
    }

    /**
     * Set the user fields to request from LINE.
     *
     * @param  array  $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Verify用のURLを取得する
     */
    protected function getVerifyUrl()
    {
        return 'https://api.line.me/oauth2/v2.1/verify';
    }

    protected function usesNonce()
    {
        return ! $this->nonceless;
    }

    protected function getNonce()
    {
        return Str::random(40);
    }

    public function nonceless()
    {
        $this->nonceless = true;

        return $this;
    }

    protected function isNonceless()
    {
        return $this->nonceless;
    }

    /**
     * 確認結果のレスポンスを取得する
     */
    public function getVerifyResultResponse()
    {
        $response = $this->getHttpClient()->post($this->getVerifyUrl(), [
            'headers' => ['Accept' => 'application/json'],
            'form_params' => $this->getVerifyFields(),
        ]);
        return json_decode($response->getBody(), true);
    }

    /**
     * 確認用のリクエストボディを取得する
     */
    protected function getVerifyFields()
    {
        return [
            'id_token' => $this->verifyIdToken,
            'client_id' => $this->verifyClientId,
            'nonce' => $this->request->session()->get('nonce'),
        ];
        // id_token,nonce=OK, client_id=NG（envヘルパで値を取得ならOK）
    }

    public function setIdToken($id_token)
    {
        $this->verifyIdToken = $id_token;
    }

    public function setVerifyClientId($client_id)
    {
        $this->verifyClientId = $client_id;
    }
}
