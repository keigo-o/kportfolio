<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/notebook_styles.css" type="text/css">
<head>
  <meta charset="UTF-8">
  <title>お問い合わせ完了画面</title>
  <style>
    .inner {
      /* margin: auto; */
      padding: 30px 20px;
      /* width: 500px; */
      height: auto;
      display: inline-block;
      border: 1px solid #dcdcdc;
      box-shadow: 0px 0px 8px #dcdcdc;
      text-align: center;

      width: 50%;
      /* margin: 0 auto; */
      /* max-width: 500px; */
    }

    h1 {
      font-size: 25px;
    }

    h2 {
      font-size: 20px;
    }

    p {
      margin-left: 0px; font-size: 15px;
    }
    .outer{
      text-align: center;
      margin-top: 100px;
    }
    .outer_back_top_btn{
      text-align: center;
      margin-top: 0px;
    }

    .back_top_btn{
      display: inline-block;
      text-align: left;
      width: 50%;
    }
  </style>
  </head>
  <body>
    <div class="outer">
      <div class="inner">
        <section>
          <h1>お問い合わせ完了画面</h1>
          <h2 class="error-message">{{ __('送信が完了しました。') }}</h2>
          <br>
          <p class="error-detail">ご連絡ありがとうございます。<br>内容を確認して、折り返しご連絡いたします。</p>
        </section>
      </div>
    </div>
    <br>
    <div class="outer_back_top_btn">
      <div class="back_top_btn">
        <a href="{{ url('/') }}" class="btn btn-primary">トップ画面に戻る</a>
      </div>
    </div>
  </body>
</html>