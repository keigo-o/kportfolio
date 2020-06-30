<!DOCTYPE html>
<html lang="ja">
    <!-- Head Section -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>行動管理ビジネス手帳サイト　予定削除</title>
        <meta name="description" content='行動管理ビジネス手帳サイトの予定削除画面'>

        <link rel="stylesheet" href="/css/notebook_styles.css" type="text/css">
        <!-- ミニカレンダーの表示　JQuery -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- フラッシュメッセージ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{ asset('js\notebook_form.js') }}" defer></script>
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

                <!-- Delete Section -->
                <div class="input col-sm-12 col-lg-10" id="main">
                    {{-- 日付連番が11以上になったら、エラーを返す --}}
                    <div class="row">
                        <div class="border col-sm-11 col-lg-9 mt-3 mr-5 mb-3 ml-3">
                            <br>
                            <h2>予定の削除</h2>
                            <form action="/notebook/delete" method="post" name="input_form">
                                @csrf
                                @foreach($form as $val)
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="users_id" value="{{ $val->users_id }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="serialnum" value="{{ $val->serialnum }}">
                                    </div>
                                    <label for="select1">管理選択：</label>
                                    <div class="form-check form-check-inline">
                                        <input
                                            type="hidden"
                                            class="form-check-input"
                                            name="select"
                                            value="{{ $val->select }}"
                                            disabled="disabled"
                                        >
                                        @switch($val->select)
                                            @case(1)
                                                <p>タスク管理</p>
                                                @break
                                            @case(2)
                                                <p>単発予定管理</p>
                                                @break
                                            @case(3)
                                                <p>プラベート</p>
                                                @break
                                            @case(4)
                                                <p>プロジェクト管理</p>
                                                @break
                                        @endswitch
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-lg-3 col-xl-3 col-form-label" for="project">プロジェクト名：</label>
                                        <div class="col-sm-12 col-lg-9 col-xl-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="project"
                                                value="{{ $val->project }}"
                                                disabled="disabled"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-lg-3 col-xl-3 col-form-label" for="title">タイトル入力：</label>
                                        <div class="col-sm-12 col-lg-9 col-xl-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="title"
                                                value="{{ $val->title }}"
                                                id="title"
                                                disabled="disabled"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-lg-2 col-form-label" for="start_day">開始日付：</label>
                                        <div class="col-sm-12 col-lg-4 mb-3">
                                            <input
                                                type="date"
                                                class="form-control"
                                                name="start_day"
                                                value="{{ $val->start_day }}"
                                                id="start_day"
                                                disabled="disabled"
                                            >
                                        </div>
                                        <label class="col-sm-12 col-lg-2 col-form-label" for="start_time">開始時間：</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input
                                                type="time"
                                                class="form-control"
                                                name="start_time"
                                                value="{{ $val->start_time }}"
                                                id="start_time"
                                                disabled="disabled"
                                            >
                                        </div>
                                        <div class="w-100"></div>
                                        <label class="col-sm-12 col-lg-2 col-form-label" for="end_day">終了日付：</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input
                                                type="date"
                                                class="form-control"
                                                name="end_day"
                                                value="{{ $val->end_day }}"
                                                id="end_day"
                                                disabled="disabled"
                                            >
                                        </div>
                                        <label class="col-sm-12 col-lg-2 col-form-label" for="end_time">終了時間：</label>
                                        <div class="col-sm-12 col-lg-4 mb-3">
                                            <input
                                                type="time"
                                                class="form-control"
                                                name="end_time"
                                                value="{{ $val->end_time }}"
                                                id="end_time"
                                                disabled="disabled"
                                            >
                                        </div>
                                    </div>

                                        <label class="form-check-label" for="all_day">終日</label>
                                        <div class="form-check form-check-inline">
                                            <input
                                                type="hidden"
                                                class="form-check-input"
                                                name="all_day"
                                                value="{{ $val->all_day }}"
                                                id="all_day"
                                            >
                                            <p>{{ $val->all_day }}</p>
                                        </div>
                                    <br>
                                    <div class="w-100"></div>
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-lg-2 col-form-label" for="alarm">アラーム：</label>
                                        <div class="col-sm-12 col-lg-4 mb-3">
                                            <input
                                                type="time"
                                                class="form-control"
                                                name="alarm"
                                                value="{{ $val->alarm }}"
                                                id="alarm"
                                                disabled="disabled"
                                            >
                                        </div>
                                    </div>

                                    <label for="importance1">重要度：</label>
                                    <div class="form-check form-check-inline">
                                        <input
                                            type="hidden"
                                            class="form-check-input"
                                            name="importance"
                                            value="{{ $val->importance }}"
                                            id="importance1"
                                        >
                                        @switch($val->importance)
                                            @case(1)
                                                <p>大</p>
                                                @break
                                            @case(2)
                                                <p>中</p>
                                                @break
                                            @case(3)
                                                <p>小</p>
                                                @break
                                        @endswitch
                                    </div>
                                    <div class="form-group">
                                        <label for="schedule">予定内容：</label>
                                        <textarea
                                            class="input-textarea form-control"
                                            name="schedule"
                                            cols="6"
                                            rows="3"
                                            disabled="disabled"
                                            id="schedule">{{ $val->schedule }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="memo">メモ：</label>
                                        <textarea
                                            class="input-textarea form-control"
                                            name="memo"
                                            cols="6"
                                            rows="3"
                                            disabled="disabled"
                                            id="memo">{{ $val->memo }}</textarea>
                                    </div>
                                    <div>
                                        <input type="submit" value="予定内容を削除する" class="btn btn-primary">
                                    </div>
                                    <br>
                                    <!-- 終了時間を自動変更するJavaScriptの動作保証のため、以下の項目は最後に記述する
                                        （入力画面と項目のインデックス番号を一致させるため） -->
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="input_id" value="{{ $val->input_id }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="created_at" value="{{ $val->created_at }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="updated_at" value="{{ $val->updated_at }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="deleted_at" value="{{ $val->deleted_at }}">
                                    </div>
                                @endforeach
                            </form>
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