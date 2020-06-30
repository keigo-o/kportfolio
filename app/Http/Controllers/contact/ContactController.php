<?php

namespace App\Http\Controllers\contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ContactSendmail;

/**
 * お問い合わせコントローラークラス.
 */
class ContactController extends Controller
{
    /**
     * フォーム画面に遷移する.
     */
    public function index()
    {
        return view('portfolio.contact.index');
    }

    /**
     * フォームに入力した内容を表示する.
     */
    public function confirm(Request $request)
    {
        //バリデーション
        $request->validate([
            'email' => 'required|email:rfc,dns,strict',
            'title' => 'required',
            'body' => 'required',
        ]);

        //フォームのすべての値を取得
        $inputs = $request->all();

        //確認フォームの情報をviewに渡して表示
        return view('portfolio.contact.confirm', ['inputs' => $inputs,]);
    }

    /**
     * 確認した内容を送信する.
     */
    public function send(Request $request)
    {
        //バリデーション
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'body'  => 'required'
        ]);

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');

        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        //actionの値で分岐
        // フォームアクションの値がsubmitではない場合
        if($action !== 'submit'){

            // リダイレクト
            return redirect()
                // お問い合わせ入力画面へ
                ->route('contact.index')
                // 入力情報をフラッシュデータとして保存して渡す
                ->withInput($inputs);

        } else {
            //入力されたメールアドレスにメールを送信
            \Mail::to($inputs['email'])->send(new ContactSendmail($inputs));

            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();

            //送信完了ページのviewを表示
            return view('portfolio.contact.thanks');
        }
    }
}
