<!DOCTYPE html>
<html lang="ja">
    <head>
      <meta charset="UTF-8">
      <!-- タイトルと説明 -->
      <title>プロフィール</title>
      <meta name="description" content=''>
      <!-- レスポンシブ対応 -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="/css/notebook_styles.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <header class="navbar navbar-dark bg-dark">
                <span class="navbar-brand">プロフィール</span>
                {{--  <a href="{{ route('logout') }}" class="btn btn-primary">ログアウト</a>  --}}
            </header>
        </div>
        <br>
        <div class="container ml-3 mr-3">
        <div class="border col-sm-12 col-lg-10">
            <br>
            <span>
                【名前】<br>
                XXXXX<br><br>

                【経歴】<br>
                XXXXXXXXXXXXXXXXXXXXXXXXXX

                【転職の動機】<br>
                XXXXXXXXXXXXXXXXXXXXXXXXXX

                【自己PR】<br>
                XXXXXXXXXXXXXXXXXXXXXXXXXX

                【その他のスキル】<br>
                XXXXXXXXXXXXXXXXXXXXXXXXXX
            </span>
        </div>
            <br>
            <div>
                <a href="{{ url('/') }}" class="btn btn-primary">トップに戻る</a>
            </div>
        </div>
    </body>
</html>