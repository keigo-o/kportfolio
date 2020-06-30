<!DOCTYPE html>
<html lang="ja">
    <!-- Head Section -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>使い方　カレンダー表示画面</title>
        <meta name="description" content='行動管理ビジネス手帳サイトの使い方　カレンダー表示画面'>

        <link rel="stylesheet" href="/css/notebook_styles.css" type="text/css">
        <!-- ミニカレンダーの表示　JQuery -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- フラッシュメッセージ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
    <!-- End Head Section -->
    <body>
        <!-- Main Container -->
        <div class="container">

            <!-- Header -->
            <div class="row">
                @include('layouts.notebook.header.header')
            </div>
            <div class="row">

                <!-- SideMenu -->
                @include('layouts.notebook.side_menu.side')

                <!-- List Section -->
                <div class="show col-sm-12 col-lg-10" id="main">
                    <div class="row">
                        <div class="border col-sm-12 col-lg-11 mt-3 mr-0 mb-3 ml-3">
                            <br>
                            <h4>アプリの使い方　カレンダー表示画面</h4>
                            <div class="container mt-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        カレンダー表示画面 >> <a href="{{ route('notebook.howtoinput') }}" class="">予定入力画面</a> >> <a href="{{ route('notebook.howtoschedulelist') }}" class="">スケジュール一覧</a>
                                    </div>
                                    <div class="card-body">
                                            <img src="/storage/images/notebook_howtouse_calendar.png" alt="行動管理ビジネス手帳　使い方　カレンダー画面" width="100%" class=""/>
                                    </div>
                                    <div class="card-footer">
                                        <span class="mr-2">
                                            <h5><b>ヘッダー部分</b></h5>
                                            <b>タイトル：</b>行動管理ビジネス手帳のロゴ<br>
                                            <b>ユーザー名：</b>ユーザー登録時に使用した氏名が表示されます。<br>
                                            <b>ログアウトボタン：</b>ログアウトしてからポートフォリオのトップ画面に移動します。<br><br>
                                            <h5><b>メニュー部分</b></h5>
                                            <b>カレンダー表示：</b>表示されているカレンダー（今月）を表示します。<br>
                                            <b>予定入力：</b>カレンダーに予定を入力する画面に移動します。<br>
                                            <b>スケジュール一覧：</b>月毎にスケジュールを一覧表示する画面に移動します。<br>
                                            <b>アプリの使い方：</b>行動管理ビジネス手帳の使い方を説明している画面に移動します。<br>
                                            <b>ポートフォリオに戻る：</b>ポートフォリオのトップ画面に移動します。<br><br>
                                            <h5><b>カレンダー部分</b></h5>
                                            <b>重要度色と連日予定色分け：</b>予定入力画面の重要度設定で表示する色が変わります。<br>
                                            <b>現在の年月：</b>現在カレンダーとして画面に表示されている年月が表示されます。<br>
                                            <b>前月リンクと翌月リンク：</b>クリックすると、前月または翌月に移動します。年を跨ぐ場合はこちらをご利用ください。<br>
                                            <b>該当年の各月タブ：</b>クリックすると現在の年の各月へ移動します。<br>
                                            <b>時間入り表示：</b>予定入力画面で開始時間を入力した場合に表示されます。<br>
                                            <b>時間なし表示：</b>予定入力画面で開始時間を入力しなかった場合に時間なしで表示されます。<br>
                                            <b>連日予定の表示：</b>予定入力画面で開始日付と終了日付が不一致の場合のみ、翌日以降の予定は「連日予定」の色で表示されます。翌日以降の予定表示は先頭が「...」で始まります。<br>
                                            <b>日付をクリック：</b>カレンダーの各日の数字をクリックすると、その日の入力画面に移動します。<br>
                                            <b>予定をクリック：</b>カレンダーに表示された予定をクリックすると、各予定の内容確認（編集画面）に移動します。<br><br>
                                            <b>祝日表示について：</b>内閣府の祝日データが元になっています。<br><br>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Section -->
            @include('layouts.notebook.footer.footer')
        </div>
        <!-- Main Container Ends -->
    </body>
</html>