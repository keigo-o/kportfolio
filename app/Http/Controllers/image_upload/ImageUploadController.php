<?php

namespace App\Http\Controllers\image_upload;

use App\Http\Requests\image_upload\ImageUploadRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

/**
 * 画像をアップロードするクラス.
 */
class ImageUploadController extends Controller
{
    /**
     * プロフィール登録フォームの表示
     *
     * @return Response
     */
    public function index()
    {
        // 画像存在フラグ設定：初期値false
        $is_image = false;

        // ログインユーザー番号の画像ファイル名が、所定の場所に存在している場合
        if(Storage::disk('local')->exists($this->getImagePath() . '/' . $this->getImageFileName())){
            // 画像存在フラグをtrueに変更
            $is_image = true;
        }
        // 画像存在フラグをパラメータに渡して、画像アップロードトップ画面へ遷移
        return view('image_upload/index', ['is_image'=>$is_image]);
    }

    /**
     * プロフィールの保存
     *
     * @param ImageUploadRequest $req
     * @return Response
     *
     */
    public function store(ImageUploadRequest $req)
    {
        // ImageUploadRequestのバリデーションを通過したら
        // 所定の場所に「ログインユーザー番号.jpg」ファイルを保存する
        $req->photo->storeAs($this->getImagePath(), $this->getImageFileName());
        // $req->photo->storeAs('public/image_upload_images', Auth::id().'.jpg');

        // 画像アップロードトップ画面に遷移する
        return redirect('image_upload')->with('success', '新しいプロフィールを登録しました');
    }

    /**
     * アップロード画像の表示
     */
    public static function getImagePath()
    {
        return 'public/image_upload_images';
    }

    public static function getImageFileName()
    {
        return Auth::id() . '.jpg';
    }
}
