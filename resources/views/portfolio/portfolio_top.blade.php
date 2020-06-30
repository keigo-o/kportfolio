<!DOCTYPE html>
<html lang="ja">
    <head>
      <meta charset="UTF-8">

      <!-- タイトルと説明 -->
        <title>KO-portfolio.site ポートフォリオ プログラマーを目指す 東京都23区在住</title>
        <meta name="description" content="転職でプログラマーを目指す。ポートフォリオです。東京都23区在住。前職は印刷業界で勤務。">

      <!-- レスポンシブ対応 -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

      <!-- フラッシュメッセージ -->
        <link rel="stylesheet" href="css/portfolio_styles.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      <!-- ＃リンクのスムーズスクロール -->
        <script>
          $(function(){
            // #で始まるリンクをクリックしたら実行
            $('a[href^="#"]').click(function() {
              var speed = 500; // スクロールの速度（ミリ秒）
              var href= $(this).attr("href");
              var target = $(href == "#" || href == "" ? 'html' : href);
              var position = target.offset().top;
              $('body,html').animate({scrollTop:position}, speed, 'swing');
              return false;
            });
          });
        </script>
    </head>

    <body>
    <!-- View flash message -->
      <script>
        @if (session('flash_message'))
          $(function () {
            toastr.success('{{ session('flash_message') }}');
          });
        @endif
      </script>

      <!-- Main Container -->
      <div class="container">
        <header class="header" id="header">
          <div class="main-header">
            <div class="header-logo">
              <img src="/storage/images/ko_portfolio_site_logo.png" alt="KO-portfolio.site logo" class="site_logo_img" width="">
            </div>
            <div class="main-menu">
              <ul class="main-menu-ul">
                <li class="main-menu-li"><span class="mgr-30"><a href="{{ action('FunctionDescription\FunctionDescriptionController@index') }}" class="a-main-menu">制作環境</a></span></li>
                <li class="main-menu-li"><span class="mgr-30"><a href="{{ action('profile\ProfileController@index') }}" class="a-main-menu">プロフィール</a></span></li>
                <li class="main-menu-li"><span class="mgr-30"><a href="{{ action('contact\ContactController@index') }}" class="a-main-menu">連絡</a></span></li>
                @auth
                <li class="main-menu-li"><span class="mgr-30"><a href="{{ route('logout') }}" class="a-main-menu">ログアウト</a></span></li>
                @endauth
                @guest
                <li class="main-menu-li"><span class="mgr-30"><a href="{{ route('login') }}" class="a-main-menu">ログイン</a></span></li>
                @endguest
              </ul>
            </div>
          </div>
        </header>
        <!-- Hero Section -->
        <section class="intro">
          <div class="column">
            {{-- <h3></h3> --}}
            {{-- <img src="/storage/images/profile_img03.png" alt="" class="profile"> </div>  --}}
            <img src="/storage/images/profile_person.png" alt="" class="profile">
          </div>
          <!-- プロフィール　氏名　人物紹介 -->
          <div class="column">
            @include('layouts.portfolio.profile')
          </div>
        </section>

        <!-- 1st Section -->
        <div class="gallery">
          @include('layouts.portfolio.each_function.thum_notebook')
          @include('layouts.portfolio.each_function.thum_bbs')
          @include('layouts.portfolio.each_function.thum_imageupload')
          @include('layouts.portfolio.each_function.thum_sample')
        </div>

        <!-- 2rd Section -->
        <div class="gallery">
          @include('layouts.portfolio.each_function.thum_sample')
          @include('layouts.portfolio.each_function.thum_sample')
          @include('layouts.portfolio.each_function.thum_sample')
        </div>

        <!-- Footer Section -->
        <footer id="contact">
          <!-- Copyrights Section -->
          <div class="copyright">
            &copy;2019-2020 - KO-portfolio.site
          </div>
        </footer>
      </div>

      <!-- Upper Icon -->
      <a href="#header" class="upper"><img src="/storage/images/upper_icon.png" alt="" width=""></a>
      <!-- Main Container Ends -->
    </body>
</html>