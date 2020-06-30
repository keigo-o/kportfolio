            <!-- Side Menu カレンダーの左横にメニューを表示-->
            <div class="side-menu col-sm-10 col-lg-2" id="side-menu">
                <div class="list-group side-menu-main">
                        <a class="list-group-item list-group-item-primary">メニュー</a>
                        <a class="list-group-item list-group-item-action" href="{{ action('notebook\NotebookController@index') }}">カレンダー表示</a>
                        <a class="list-group-item list-group-item-action" href="{{ action('notebook\NotebookController@add') }}">予定入力</a>
                        <a class="list-group-item list-group-item-action" href="{{ action('notebook\NotebookController@show') }}">スケジュール管理</a>
                        {{-- <a class="list-group-item list-group-item-action" href="">予定を優先順に表示</a> --}}
                        {{-- <a class="list-group-item list-group-item-action" href="">カレンダー削除</a> --}}
                        <a class="list-group-item list-group-item-action" href="{{ action('notebook\NotebookController@showHowToCalendar') }}">アプリの使い方</a>
                        <a class="list-group-item list-group-item-action" href="{{ url('/') }}">ポートフォリオに戻る</a>
                </div>
            </div>

            <!-- Side Menu カレンダーの上にメニューを表示（レスポンシブデザイン）-->
            <div class="col-sm-12 mt-2" id="side-menu-responsive">
                <nav class="side-menu-responsive">
                    <ul class="side-ul">
                        <li class="side-li"><a class="" href="{{ action('notebook\NotebookController@index') }}">カレンダー表示</a></li>
                        <li class="side-li"><a class="" href="{{ action('notebook\NotebookController@add') }}">予定入力</a></li>
                        <li class="side-li"><a class="" href="{{ action('notebook\NotebookController@show') }}">スケジュール管理</a></li>
                        {{-- <li class="side-li"><a class="" href="">予定を優先順に表示</a></li> --}}
                        {{-- <li class="side-li"><a class="" href="">カレンダー削除</a></li> --}}
                        <li class="side-li"><a class="" href="{{ action('notebook\NotebookController@showHowToCalendar') }}">アプリの使い方</a></li>
                        <li class="side-li"><a class="" href="{{ url('/') }}">ポートフォリオに戻る</a></li>
                    </ul>
                </nav>
            </div>
