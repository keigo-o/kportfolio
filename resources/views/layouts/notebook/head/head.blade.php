    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>行動管理ビジネス手帳サイト</title>
        {{-- ここはまだわからない　何故ローカルとサーバーで「/」のあり・なしが存在してしまうのか --}}
        <link rel="stylesheet" href="css/notebook_styles.css" type="text/css">
        <link rel="stylesheet" href="/css/notebook_styles.css" type="text/css">
        {{-- 100vhがしたかったけど保留になったので、一旦コメントアウト --}}
        {{-- <script type="text/javascript" src="js/notebook.js"></script> --}}

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