<!DOCTYPE html>
<html lang="ja">
    <head>
      <meta charset="UTF-8">
      <!-- タイトルと説明 -->
      <title>お問い合わせ内容の確認画面</title>
      <meta name="description" content=''>
      <!-- レスポンシブ対応 -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="/css/notebook_styles.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <header class="navbar navbar-dark bg-dark">
                <span class="navbar-brand">お問い合わせ</span>
                <a href="{{ route('logout') }}" class="btn btn-primary">ログアウト</a>
            </header>
        </div>
        <br>
        <div class="container ml-3 mr-3">
        <div class="border col-sm-12 col-lg-7">
            <br>
            <h4>入力内容の確認</h4>
            <br>
            <div class="row">
                <div class="col-md">
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="form-group">
                            <label>メールアドレス</label>
                            <input
                                class="form-control"
                                name="email"
                                value="{{ $inputs['email'] }}"
                                type="text"
                                readonly="readonly"
                            >
                        </div>
                        <div class="form-group">
                            <label>件名</label>
                            <input
                                class="form-control"
                                name="title"
                                value="{{ $inputs['title'] }}"
                                type="text"
                                readonly="readonly"
                            >
                        </div>
                        <div class="form-group">
                            <label>お問い合わせ内容</label>
                            <textarea
                                class="form-control"
                                name="body"
                                value=""
                                type="textarea"
                                readonly="readonly">{{ $inputs['body'] }}</textarea>
                        </div>
                            <button type="submit" name="action" value="back" class="btn btn-primary">
                                入力内容修正
                            </button>
                            <button type="submit" name="action" value="submit" class="btn btn-primary">
                                送信する
                            </button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
            <br>
            <div>
                <a href="{{ url('/') }}" class="btn btn-primary">トップに戻る</a>
            </div>
        </div>
    </body>
</html>