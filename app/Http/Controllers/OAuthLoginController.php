<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Log;

class OAuthLoginController extends Controller
{
    // LINEでログインをクリックした場合　ユーザー情報使用許可画面へ遷移
    public function lineLogin()
    {
        Log::info('LINEログインのユーザー情報使用許可画面へ遷移します');
        return view('auth.line_login');
    }

    // SNS認証ページへのリダイレクト処理
    public function getAuth() {
        Log::info('SNS認証の処理を開始します');

        // basename — パスの最後にある名前の部分を返す。
        $social = basename(parse_url($this->getUrl(), PHP_URL_PATH));

        // Socialiteクラスの静的メソッドのdriverに（引数に$socialを渡して）アクセスする。
        return Socialite::driver($social)->redirect();
    }

    private function getUrl() {
        return (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    }

    // SNS認証情報からユーザー情報の取得
    public function authCallback()
    {
        $social = basename(parse_url($this->getUrl(), PHP_URL_PATH));

        // LINE以外でログイン認証した場合のユーザー情報登録処理
        if($social !== 'line' ){
            Log::info('LINE以外のauthCallbackメソッドを開始します');
            $socialUser = Socialite::driver($social)->stateless()->user();

            $user = User::firstOrNew(['email' => $socialUser->email]);

            if (! $user->exists) {
                $user['name'] = $socialUser->getNickName() ?? $socialUser->getName() ?? $socialUser->getNick();
                $user['email'] = $socialUser->email; // メールアドレス
                $user['password'] = Str::random(); // 適当に生成 laravel6からこちらの記述に変更 str_random()は廃止

                $user->save();
            }

            Auth::login($user);

            Log::info('LINE以外のauthCallbackメソッドを終了します');
            return redirect()->intended('/');

        // LINEでログイン認証した場合のユーザー情報登録処理
        } elseif ($social === 'line'){
            Log::info('LINEのauthCallbackメソッドを開始します');

            $socialUser = Socialite::driver($social)->stateless()->user();

            $socialName = $socialUser['name'];
            $socialEmail = $socialUser['email'];

            $user = User::firstOrNew(['email' => $socialEmail]);

            if (!$user->exists) {
                $user['name'] = $socialName;
                $user['email'] = $socialEmail; // LINEアドレス
                $user['password'] = Str::random(); // 適当に生成 laravel6からこちらの記述に変更 str_random()は廃止

                // User::firstOrNewをしているためsave()する。
                $user->save();
            }

            Auth::login($user);

            Log::info('LINEのauthCallbackメソッドを終了します');
            return redirect()->intended('/');
        }
    }
}
