<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <style>
    .inner {
      /* margin: auto; */
      padding: 5px 20px;
      /* width: 500px; */
      height: auto;
      display: inline-block;
      border: 1px solid #dcdcdc;
      box-shadow: 0px 0px 8px #dcdcdc;
      text-align: left;

      width: 70%;
      /* margin: 0 auto; */
      /* max-width: 500px; */
    }

    h1 {
      font-size: 18px;
    }

    p {
      margin-left: 10px; font-size: 12px;
    }
    .outer{
      text-align: center;
      margin: 100px;
    }
  </style>
</head>
<body>
  <div class="outer">
    <div class="inner">
      <section>
        <h1>@yield('title')</h1>
        <p class="error-message">@yield('message')</p>
        <p class="error-detail">@yield('detail')</p>
        @yield('link')
      </section>
    </div>
  </div>
</body>
</html>