            <header class="header col-12" id="header">
                <div class="header-main">
                    <div class="header-content-1st">
                        <img src="/storage/images/notebook_title_img_logo.png" alt="ロゴ　行動管理ビジネス手帳" width="" class="notebook_title"/>
                    </div>
                    <div class="header-content-2nd">
                        <h4 class="user_name">ユーザー名：{{ $user->name }}</h4>
                        <div class="login_or_out">
                            <a class="btn btn-warning rounded-pill" href="{{ route('logout') }}" role="button"">ログアウト</a>
                        </div>
                    </div>
                </div>
            </header>