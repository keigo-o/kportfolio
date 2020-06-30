<!DOCTYPE html>
<html lang="ja">
    <head>
      <meta charset="UTF-8">
      <!-- タイトルと説明 -->
      <title>機能説明</title>
      <meta name="description" content=''>
      <!-- レスポンシブ対応 -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="/css/notebook_styles.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <header class="navbar navbar-dark bg-dark">
                <span class="navbar-brand">機能説明</span>
                {{--  <a href="{{ route('logout') }}" class="btn btn-primary">ログアウト</a>  --}}
            </header>
        </div>
        <br>
        <div class="container ml-3 mr-3">
        <div class="border col-sm-12 col-lg-10">
            <br>
            <span>
                【制作内容】<br>
                <a href="{{ url('/') }}">本ポートフォリオサイト</a>の企画・構成・制作、<a href="{{ route('notebook') }}">行動管理ビジネス手帳アプリ</a>の企画・構成・制作。<br>
                ドメイン取得、レンタルサーバー契約、開発環境と実行環境の環境構築、開発環境と実行環境でlaravelのインストール、その他付随する環境構築。<br><br>

                【制作期間】二ヶ月半<br><br>

                【制作環境・使用言語・使用エディタなど】<br>
                Windows10, PHP7.3, laravel6, HTML, CSS, Bootstrap4, Visual Studio Code, GitHub, Tera Term, WinSCP<br>
                開発環境：xampp/phpMyAdmin/MariaDB and AWS Cloud9<br>
                実行環境：レンタルサーバー, phpMyAdmin/MySQL5.6<br><br>

                【主な実装一覧】<br>
                ・ログイン機能（laravel6デフォルト）<br>
                ・ソーシャルログイン機能（laravel6ソーシャライトによるgoogleログイン）<br>
                ・laravel6ソーシャライトを継承してLINEログイン（LINEで任意のnonceも設定）<br>
                ・HTTPセッション（データベースを利用　設定30分）<br>
                ・ログインユーザー登録時の登録完了メール配信（ソーシャルログインを除く）<br>
                ・エラー画面の独自実装<br>
                ・内閣府から祝日ファイル（csv）をダウンロードしてデータを加工後、サイト内でファイルをアップロードしてサーバーに登録。<br>
                ・レスポンシブデザイン<br><br>

                【留意点】<br>
                掲示板、画像アップロードは手帳アプリを作成前に学習用として、インターネットに掲載されているコードを教材として使用したものです。<br><br>
            </span>
        </div>
            <br>
            <div>
                <a href="{{ url('/') }}" class="btn btn-primary">トップに戻る</a>
            </div>
        </div>
    </body>
</html>