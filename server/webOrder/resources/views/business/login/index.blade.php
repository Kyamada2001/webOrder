<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/business/app.css') }}" rel="stylesheet">
    <title>web総合管理</title>
</head>
<body>
<div id="app" class="flex justify-center items-center bg-gray-200 w-full h-full">
    <div class="bg-white w-11/12 md:w-2/3 rounded-sm">
        <div class="px-2 py-3 bg-gray-800 text-white rounded-sm">ログイン</div>
        <form action="{{ route('business.login.authenticate') }}" method="post">
            @csrf
            <div class="px-2 py-3 space-y-3">
                <div class="space-y-3">
                    <div>
                        <input type="text" placeholder="ログインID" name="name" class="px-2 py-2 w-full text-gray-700 border ring-stone-100 rounded-sm focus:shadow-outline outline-black  @error('name') border-red-400 @enderror">
                    </div>
                    <div>
                        <input type="password" placeholder="パスワード" name="password" class="px-2 py-2 w-full text-gray-700 border ring-stone-100 rounded-sm focus:shadow-outline outline-black  @error('password') border-red-400 @enderror">
                    </div>
                </div>
                <div class="flex justify-center">
                    <button class="rounded bg-gray-800 text-white px-3 py-2 hover:bg-gray-500">ログイン</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/business/app.js') }}"></script>
@yield('script')
</body>
</html>