<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/customer/app.css') }}" rel="stylesheet">
    <title>webオーダー</title>
</head>
<body>
    <div id="app" class="h-full">
       <Home/>
    </div>
<script src="{{ asset('js/customer/app.js') }}"></script>
</body>
</html>