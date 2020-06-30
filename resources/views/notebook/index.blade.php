<!DOCTYPE html>
<html lang="ja">
    <!-- Head Section -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>行動管理ビジネス手帳サイト　カレンダー</title>
        <meta name="description" content='行動管理ビジネス手帳サイトのカレンダー画面'>
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
    <script>
        @if (session('flash_message'))
            $(function () {
                    toastr.success('{{ session('flash_message') }}');
            });
        @endif
    </script>
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
                <!-- Calender Section -->
                <div class="input col-sm-12 col-lg-10" id="main">
                    <div class="row">
                        <div class="calendar-main  col-sm-12 coll-lg-12">
                            <div class="clerafix">
                                <div class="float-right mr-2">
                                    重要度：<span class="importance_mark1">大</span>&ensp;<span class="importance_mark2">中</span>&ensp;<span class="importance_mark3">小</span>&ensp;<span class="duble_schedule">連日予定</span>
                                </div>
                            </div>
                            <!-- サイト内検索を実装予定 -->
                            <div>
                                <!-- メインカレンダーはNotebookCalendar.php内で作成している -->
                                {!! $cal_tag !!}
                            <!-- </div>はNotebookCalendar.php内で記載 -->
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