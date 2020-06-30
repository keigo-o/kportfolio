<!DOCTYPE html>
<html lang="ja">
    <!-- Head Section -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>行動管理ビジネス手帳サイト　予定入力</title>
        <meta name="description" content='行動管理ビジネス手帳サイトの予定入力画面'>
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
                <!-- Input Section -->
                <div class="input col-sm-12 col-lg-10" id="main">
                    <div class="row">
                        <div class="border col-sm-11 col-lg-9 mt-3 mr-5 mb-3 ml-3">
                            <br>
                            <h2>予定入力</h2>
                            <span class="hissu">「*」の項目は必須入力です。</span>
                            <div>
                                @if(count($errors) > 0)
                                    <div>
                                        <p>以下の入力エラーが出ています。エラーを解消してください。</p>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <span class="badge badge-danger">入力エラー</span><ul class="error-message">{{ $error }}</ul>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <form action="/notebook/input" method="post" name="input_form">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="users_id" value="{{ $user->id }}">
                                </div>
                                <div class="form-group">
                                <input type="hidden" class="form-control" name="serialnum" value="13">
                                </div>
                                <label for="select1">管理選択：</label>
                                <div class="form-check form-check-inline">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="select"
                                        value="1"
                                        id="select1"
                                        @if(1 == old('select')) checked @endif
                                        @if(null == old('select')) checked @endif
                                        onClick="changeProjectDisabled();"
                                    >
                                    <label class="form-check-label" for="select1">タスク管理</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="select"
                                        value="2"
                                        id="select2"
                                        @if(2 == old('select')) checked @endif
                                        onClick="changeProjectDisabled();"
                                    >
                                    <label class="form-check-label" for="select2">単発予定管理</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="select"
                                        value="3"
                                        id="select3"
                                        @if(3 == old('select')) checked @endif
                                        onClick="changeProjectDisabled();"
                                    >
                                    <label class="form-check-label" for="select3">プラベート</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="select"
                                        value="4"
                                        id="select4"
                                        @if(4 == old('select')) checked @endif
                                        onClick="changeProjectDisabled();"
                                    >
                                    <label class="form-check-label" for="select4">プロジェクト管理</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-lg-3 col-xl-2 col-form-label" for="project">プロジェクト名:</label>
                                    <div class="col-sm-12 col-lg-9 col-xl-10">
                                        <input type="text" class="form-control" name="project" value="{{ old('project') }}" id="project" placeholder="プロジェクト管理する場合は入力必須です。" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-lg-3 col-xl-2 col-form-label" for="title">タイトル入力:<span class="hissu">*</span></label>
                                    <div class="col-sm-12 col-lg-9 col-xl-10">
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title" placeholder="予定のタイトルを入力してください。">
                                    </div>
                                </div>
                                <!-- 開始日付、開始時間、終了時間、（所要時間入れる予定）、終了日付を収納 -->
                                @include('layouts.notebook.input.startday_endday')
                                {{-- ここの datepickerコードはまだまだ短くできそうだ includeでvalueだけyieldで作成する--}}
                                <!-- 時刻プルダウンメニュー -->
                                @include('layouts.notebook.input.datalist')
                                {{-- スマホは時間選択の挙動がおかしかった　改修したい --}}
                                <div class="clearfix">
                                    <!-- 終日チェック -->
                                    <div class="form-check float-left mb-3">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            name="all_day"
                                            value="1"
                                            id="all_day"
                                            @if(1 == old('all_day')) checked @endif
                                            onClick="changeAllDayDisabled();"
                                        >
                                        <label class="form-check-label" for="all_day">終日</label>
                                    </div>
                                    <!-- 所要時間 -->
                                    <div class="float-right">
                                        <label for="select1">所要時間：</label>
                                        <div class="form-check form-check-inline">
                                            <input
                                                type="radio"
                                                class="form-check-input"
                                                name="after_minutes"
                                                value="{{ old('after_minutes') }}"
                                                id="after_minutes30"
                                                onClick="changeEndtime();"
                                            >
                                            <label class="form-check-label" for="after_minutes30">30分</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                type="radio"
                                                class="form-check-input"
                                                name="after_minutes"
                                                value="{{ old('after_minutes') }}"
                                                id="after_minutes60"
                                                onClick="changeEndtime();"
                                            >
                                            <label class="form-check-label" for="after_minutes60">60分</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                type="radio"
                                                class="form-check-input"
                                                name="after_minutes"
                                                value="{{ old('after_minutes') }}"
                                                id="after_minutes90"
                                                onClick="changeEndtime();"
                                            >
                                            <label class="form-check-label" for="after_minutes90">90分</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input
                                                type="radio"
                                                class="form-check-input"
                                                name="after_minutes"
                                                value="{{ old('after_minutes') }}"
                                                id="after_minutes120"
                                                onClick="changeEndtime();"
                                            >
                                            <label class="form-check-label" for="after_minutes120">120分</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="w-100"></div>
                                {{-- 〇〇分前などを選択して、アラームを設定する --}}
                                <div class="form-group row">
                                    <label class="col-sm-12 col-lg-2 col-form-label" for="alarm">アラーム：</label>
                                    <div class="col-sm-12 col-lg-4 mb-3">
                                        <input
                                            type="time"
                                            class="form-control"
                                            name="alarm"
                                            step="300"
                                            list="set_time"
                                            value="{{ old('alarm') }}"
                                            id="alarm"
                                        >
                                        <span>※現在アラーム機能（cron設定）は停止中です</span>
                                    </div>
                                </div>
                                <!-- 各予定の重要度　予定を優先順位に並べる際に使用する値 -->
                                <label for="importance1">重要度</label>
                                <div class="form-check form-check-inline">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="importance"
                                        value="1"
                                        id="importance1"
                                        @if(1 == old('importance')) checked @endif
                                    >
                                    <label for="importance1" class="form-check-label">大</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="importance"
                                        value="2"
                                        id="importance2"
                                        @if(2 == old('importance')) checked @endif
                                    >
                                    <label for="importance2" class="form-check-label">中</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="importance"
                                        value="3"
                                        id="importance3"
                                        @if(3 == old('importance')) checked @endif
                                        @if(null == old('importance')) checked @endif
                                    >
                                    <label for="importance3" class="form-check-label">小</label>
                                </div>
                                <div class="form-group">
                                    <label for="schedule">予定内容：</label>
                                    <textarea
                                        class="input-textarea form-control"
                                        name="schedule"
                                        cols="6"
                                        rows="3"
                                        id="schedule">{{ old('schedule') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="memo">メモ：</label>
                                    <textarea
                                        class="input-textarea form-control"
                                        name="memo"
                                        cols="6"
                                        rows="3"
                                        id="memo">{{ old('memo') }}</textarea>
                                </div>
                                <div>
                                    <input type="submit" value="新規予定を登録" class="btn btn-primary">
                                </div>
                                <br>
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