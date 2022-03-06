<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Example</title>
<link rel="stylesheet" href="{{ asset('css/customer/app.css') }}">
</head>
<body>
    <div id="app">
        <div id="nav">
          <router-link to="/home">Home</router-link>
          <router-link to="/welcome">welcome</router-link>
        </div>
        <router-view/>
    </div>

<script src="{{ asset('js/customer/app.js') }}"></script> 
</body>
</html>