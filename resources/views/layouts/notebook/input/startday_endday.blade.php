<div class="form-group row">
    @if($day == null)
        <!-- サイドメニューから画面遷移した場合は、今日の日付を表示する -->
        @include('layouts.notebook.script.datepicker_start_day')
            <label class="col-sm-12 col-lg-2 col-form-label" for="start_day">開始日付：<span class="hissu">*</span></label>
            <div class="col-sm-12 col-lg-4 mb-3">
                <input
                    type="data"
                    class="form-control"
                    name="start_day"
                    value="{{ old('start_day', $today) }}"
                    id="start_day"
                    onChange="document.input_form.end_day.value = document.input_form.start_day.value;" />
            </div>
            <label class="col-sm-12 col-lg-2 col-form-label" for="start_time">開始時間：</label>
            <div class="col-sm-12 col-lg-4">
                <input
                    type="time"
                    class="form-control"
                    name="start_time"
                    step="300"
                    list="set_time"
                    value="{{ old('start_time') }}"
                    id="start_time"
                    onChange="endTimeAndAllDayController();" />
            </div>
            <div class="w-100"></div>
            @include('layouts.notebook.script.datepicker_end_day')
            <label class="col-sm-12 col-lg-2 col-form-label" for="end_day">終了日付：<span class="hissu">*</span></label>
            <div class="col-sm-12 col-lg-4">
                <input
                    type="data"
                    class="form-control"
                    name="end_day"
                    value="{{ old('end_day', $today) }}"
                    id="end_day"
                >
            </div>
            <label class="col-sm-12 col-lg-2 col-form-label" for="end_time">終了時間：</label>
            <div class="col-sm-12 col-lg-4 mb-3">
                <input
                    type="time"
                    class="form-control"
                    name="end_time"
                    step="300"
                    list="set_time"
                    value="{{ old('end_time') }}"
                    id="end_time"
                    onChange="AllDayController();" />
            </div>
    @else
        <!-- カレンダーの日付クリックから入力画面に遷移した場合は、該当日付を表示する -->
        @include('layouts.notebook.script.datepicker_start_day')
            <label class="col-sm-12 col-lg-2 col-form-label" for="start_day">開始日付：<span class="hissu">*</span></label>
            <div class="col-sm-12 col-lg-4 mb-3">
            <input
                type="data"
                class="form-control"
                name="start_day"
                value="{{ old('start_day', $designated_date) }}"
                id="start_day"
                onChange="document.input_form.end_day.value = document.input_form.start_day.value;" />
            </div>
            <label class="col-sm-12 col-lg-2 col-form-label" for="start_time">開始時間：</label>
            <div class="col-sm-12 col-lg-4">
                <input
                    type="time"
                    class="form-control"
                    name="start_time"
                    step="300"
                    list="set_time"
                    value="{{ old('start_time') }}"
                    id="start_time"
                    onChange="endTimeAndAllDayController();" />
            </div>
            <div class="w-100"></div>
        @include('layouts.notebook.script.datepicker_end_day')
        <label class="col-sm-12 col-lg-2 col-form-label" for="end_day">終了日付：<span class="hissu">*</span></label>
        <div class="col-sm-12 col-lg-4">
            <input
                type="data"
                class="form-control"
                name="end_day"
                value="{{ old('end_day', $designated_date) }}"
                id="end_day"
            >
        </div>
        <label class="col-sm-12 col-lg-2 col-form-label" for="end_time">終了時間：</label>
        <div class="col-sm-12 col-lg-4 mb-3">
            <input
                type="time"
                class="form-control"
                name="end_time"
                step="300"
                list="set_time"
                value="{{ old('end_time') }}"
                id="end_time"
                onChange="AllDayController();" />
        </div>
    @endif
</div>