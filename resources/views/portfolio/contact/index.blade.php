<!DOCTYPE html>
<html lang="ja">
    <head>
      <meta charset="UTF-8">
      <!-- タイトルと説明 -->
      <title>お問い合わせ内容の入力画面</title>
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
            <h4>入力画面</h4>
            <br>
            <div class="row">
                <div class="col-md">
                    <form method="POST" action="{{ route('contact.confirm') }}">
                        @csrf
                        <div class="form-group">
                            <label>メールアドレス</label>
                            <input
                                class="form-control"
                                name="email"
                                value="{{ old('email') }}"
                                type="text"
                                placeholder="入力例：sample@example.com"
                                aria-hidden="">
                            <span class="focus_bg"></span>
                            @if ($errors->has('email'))
                                <p class="error-message">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>件名</label>
                            <input
                                class="form-control"
                                name="title"
                                value="{{ old('title') }}"
                                type="text"
                                placeholder="件名を入力してください。"
                                aria-hidden="">
                            <span class="focus_bg"></span>
                            @if ($errors->has('title'))
                                <p class="error-message">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>お問い合わせ内容</label>
                            <textarea
                                class="form-control"
                                name="body"
                                value=""
                                type="textarea"
                                placeholder="お問い合わせの内容を入力してください。"
                                aria-hidden="">{{ old('body') }}</textarea>
                            <span class="focus_bg"></span>
                            @if ($errors->has('body'))
                                <p class="error-message">{{ $errors->first('body') }}</p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">
                            入力内容確認
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