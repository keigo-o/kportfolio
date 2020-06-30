<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/css/notebook_styles.css" type="text/css">
</head>
<body>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif
    <form method="POST" action="/usersimport" enctype="multipart/form-data">
        @csrf
        <input type="file" id="file" name="file" class="form-control">
        <button type="submit">アップロード</button>
    </form>
</body>
</html>