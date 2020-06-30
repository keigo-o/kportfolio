<!DOCTYPE html>
<html lang="ja">
    <!-- Head Section -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>行動管理ビジネス手帳サイト　スケジュール一覧</title>
        <meta name="description" content='行動管理ビジネス手帳サイトのスケジュール一覧画面'>

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
    <script>
        @if (session('flash_message'))
            $(function () {
                    toastr.success('{{ session('flash_message') }}');
            });
        @endif
    </script>
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
                            <h2>スケジュール一覧</h2>
                            <br>
                            <form action="/notebook/show" method="post" name="show_month">
                                @csrf
                                <div class="form-group">
                                    <span>※一覧を表示したい年月を選択してください。</span>
                                    <br>
                                    <!-- 表示したい年月のプルダウンメニュー -->
                                    @include('layouts.notebook.show.select_year_and_month')
                                </div>
                                <div>
                                    <input type="submit" value="スケジュールを表示" class="btn btn-primary">
                                </div>
                            </form>
                            <br>
                            <table class="table table-hover table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <!-- <th>Box</th> -->
                                        <th>日付</th>
                                        <th>開始時間</th>
                                        <th>タイトル</th>
                                        <th>予定内容</th>
                                        <th>編集</th>
                                        <th>完了</th>
                                        <!-- <th>終日の値確認用</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($lists as $list)
                                            <tr>
                                                <!-- <td scope="row">box</td> -->
                                                <td>{{ $list->start_day }}</td>
                                                <td>{{ preg_replace('/:\d{2}$/', '', $list->start_time) }}</td>
                                                <td>{{ Illuminate\Support\Str::limit($list->title ,20) }}</td>
                                                <td>{{ Illuminate\Support\Str::limit($list->schedule ,25) }}</td>
                                                <td><a href="{{ route('notebook.edit', $list->input_id) }}">編集</a></td>
                                                <td><a href="{{ route('notebook.delete', $list->input_id) }}">削除</td>
                                                <!-- <td>{{ $list->all_day }}</td> -->
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">{{$lists->appends(request()->query())->links()}}</div>
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