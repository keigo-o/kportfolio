<!DOCTYPE html>
<html lang="ja">
    <!-- Head Section -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>使い方　予定入力画面</title>
        <meta name="description" content='行動管理ビジネス手帳サイトの使い方　予定入力画面'>

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
                            <h4>アプリの使い方　予定入力画面</h4>
                            <div class="container mt-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <a href="{{ route('notebook.howtocalendar') }}" class="">カレンダー表示画面</a> >> 予定入力画面 >> <a href="{{ route('notebook.howtoschedulelist') }}" class="">スケジュール一覧</a>
                                    </div>
                                    <div class="card-body">
                                            <img src="/storage/images/notebook_howtouse_inputSchedule.png" alt="行動管理ビジネス手帳　使い方　予定入力画面" width="100%" class=""/>
                                    </div>
                                    <div class="card-footer">
                                        <span class="mr-2">
                                            <h5><b>予定入力部分</b></h5>
                                            <b>管理選択：</b>タスク管理、単発予定管理、プライベート、プロジェクト管理の４つの区分があります。
                                            使い方はユーザーに委ねられています。<br>
                                            ・タスクはTODOリストで処理する案件<br>
                                            ・単発予定は開始時間の決まったビジネス予定。例えば会議や打ち合わせです。<br>
                                            ・プライベートは自由にお使いください。<br>
                                            ・プロジェクトは各予定も一つのプロジェクト案件の一部である場合に設定します。<br>
                                            <b>プロジェクト名：</b>管理選択でプロジェクト管理が選択されている場合にのみ入力ができます。入力しても他の管理を選択するとデータは削除されます。初期設定はタスク管理です。日本語で30文字まで入力できます。<br>
                                            <b>タイトル入力：</b>必須入力です。日本語で30文字まで入力できます。<br>
                                            <b>開始日付：</b>必須入力です。終了日付より後に設定することはできません。<br>
                                            <b>終了日付：</b>必須入力です。開始日付より前に設定することはできません。<br>
                                            <b>終日：</b>選択すると、開始時間・終了時間・所要時間は選択できなくなります。もし時間データが存在していたら時間データは削除されます。<br>
                                            <b>開始時間：</b>終了時間より後に設定することはできません。<br>
                                            <b>終了時間：</b>開始時間より前に設定することはできません。<br>
                                            <b>所要時間：</b>選択すると終了時間が変わります。<br>
                                            <b>アラーム：</b>設定された時間にユーザー登録されたメールアドレスに配信されます。<b>※現在アラーム機能は停止しています。</b><br>
                                            <b>重要度：</b>大中小の３つで重要度を設定してください。カレンダー表示画面で重要度によって色分け表示されます。初期設定は「小」です。<br>
                                            <b>予定内容：</b>日本語で500文字まで入力できます。<br>
                                            <b>メモ：</b>日本語で500文字まで入力できます。<br>
                                            <b>新規予定を登録：</b>入力した内容を登録して、カレンダー表示画面、スケジュール一覧画面に表示できるようにします。<br><br>

                                            <b>ワンポイント：</b>必須入力はタイトルと開始日付と終了日付の３箇所のみです。日付は初期設定されていますので、連日予定でない限り、タイトルのみを入力して、最短で予定を登録できます。急ぎ予定を放り込みたい場合にどうぞ。<br>
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