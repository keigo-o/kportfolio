<!DOCTYPE html>
<html lang="ja">
    <!-- Head Section -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>使い方　スケジュール一覧画面</title>
        <meta name="description" content='行動管理ビジネス手帳サイトの使い方　スケジュール一覧画面'>

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
                            <h4>アプリの使い方　スケジュール一覧画面</h4>
                            <div class="container mt-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <a href="{{ route('notebook.howtocalendar') }}" class="">カレンダー表示画面</a> >> <a href="{{ route('notebook.howtoinput') }}" class="">予定入力画面</a> >> スケジュール一覧
                                    </div>
                                    <div class="card-body">
                                            <img src="/storage/images/notebook_howtouse_scheduleList.png" alt="行動管理ビジネス手帳　使い方　スケジュール一覧画面" width="100%" class=""/>
                                    </div>
                                    <div class="card-footer">
                                        <span class="mr-2">
                                            <b>年月の指定：</b>年の選択は今年の前後10年が選択できます。例えば今年が2020年の場合は、2010年～2030年です。月の選択は各月の他にその年の全てのスケジュールを表示する「全」選択があります。選択後は「スケジュールを表示」ボタンをクリックしてください。初期設定は今月になっています。<br>
                                            <b>スケジュールを表示：</b>年月の指定後にクリックすると対象のスケジュール一覧が表示されます。<br>
                                            <b>日付：</b>予定入力画面で入力した開始日付です。<br>
                                            <b>開始時間：</b>予定入力画面で入力した開始時間です。<br>
                                            <b>タイトル：</b>予定入力画面で入力したタイトルです。<br>
                                            <b>予定内容：</b>予定入力画面で入力した予定内容です。<br>
                                            <b>編集：</b>同じ行の予定内容を編集する画面に移動します。画面移動後は修正部分を修正後、内容を更新する場合のみ「予定内容を更新する」ボタンをクリックしてください。<br>
                                            <b>完了：</b>同じ行の予定内容を削除する画面に移動します。画面移動後は内容を確認の上、削除する場合のみ「予定内容を削除する」ボタンをクリックしてください。<br>
                                            <b>ページ分け：</b>予定件数を25件毎にページ分けします。<br>
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