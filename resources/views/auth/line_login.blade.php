@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">LINEアカウントを利用してログインを行います。</div>

                <div class="card-body">


<div class="jumbotron">
    <div class="panel panel-info center-block">
        {{-- <div class="panel-heading">ログインしてください</div> --}}
        <div class="panel-body">
            本Webサービスでは、ログイン時の認証画面にて許可を頂いた場合のみ、あなたのLINEアカウントに登録されているメールアドレスを取得します。<br />
            取得したメールアドレスは、以下の目的以外では使用いたしません。また、法令に定められた場合を除き、第三者への提供はいたしません。
            <ul>
                <li>ユーザーIDとしてアカウントの管理に利用</li>
                <li>パスワード再発行時の本人確認に利用</li>
            </ul>
            <hr/>
        </div>

                            <div class="">
                                <a href="/auth/line"><img src="/storage/images/btn_login_base.png" alt="LINE LOGIN BUTTON"></a>
                           </div>

        {{-- <p class="text-center"><a asp-area="" asp-controller="Account" asp-action="{{ route('linelogin') }}">
            <img src="/storage/images/btn_login_base.png"/>
        </a>
        </p> --}}
    </div>
</div>



            </div>
        </div>
    </div>
</div>
@endsection