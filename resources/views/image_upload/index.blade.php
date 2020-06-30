<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <!-- タイトルと説明 -->
        <title>画像のアップロード</title>
        <meta name="description" content="">
        <!-- レスポンシブ対応 -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/notebook_styles.css" type="text/css">
        {{--  <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
        >  --}}
        <style>
            .upimg {
              transition: transform 0.3s ease-out;
            }
            img:hover {
              transform: rotate(10deg);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header class="navbar navbar-dark bg-dark">
                <span class="navbar-brand">画像のアップロード</span>
                <a href="{{ route('logout') }}" class="btn btn-primary">ログアウト</a>
            </header>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-8 ml-4">
                    <div class="card">
                        <div class="card-header">
                            アップされた画像
                        </div>
                        <div>
                            <form method="POST" action="/image_upload" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>
                                                        {{ $error }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if ($is_image)
                                        <figure>
                                            <img class="upimg" src="/storage/image_upload_images/{{ Auth::id() }}.jpg" width="300px">
                                            {{--  <img src="/storage/image_upload_images/{{ Auth::id() }}.jpg" width="200px" height="200px">  --}}
                                            <figcaption>現在のプロフィール画像</figcaption>
                                        </figure>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <input type="file" name="photo">
                                    <input type="submit" value="画像を登録する" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <a href="{{ url('/') }}" class="btn btn-primary ml-4">トップに戻る</a>
    </body>
</html>