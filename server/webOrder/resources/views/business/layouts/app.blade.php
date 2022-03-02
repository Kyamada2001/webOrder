<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/business/app.css') }}" rel="stylesheet">
    <title>web管理</title>
</head>
<body>
    <div class="h-20 w-full">
        <header class="flex flex-row w-full">
            <div class="text-orange-500">
                <h3 class="px-12 py-6">webOrder総合管理</h3>
            </div>
            <div class="flex flex-row absolute inset-y-0 right-0 px-4 py-6">
                <div class="px-2">
                    山田さん
                </div>
                <div>
                    ログアウト
                </div>
            </div>
        </header>
    </div>
    <div class="flex flex-row">
        <div class="relative dark:bg-gray-800 h-full w-1/4">
            <div class="flex flex-col sm:flex-row sm:justify-around">
                <div class="w-72 h-screen">
                    <nav class="mt-10 px-6 ">
                        <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="{{ route('business.shop.index') }}">
                            <span class="mx-4 text-lg font-normal">
                                店舗一覧
                            </span>
                            <span class="flex-grow text-right">
                            </span>
                        </a>
                        <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="{{ route('business.shop.create') }}">
                            <span class="mx-4 text-lg font-normal">
                                店舗登録
                            </span>
                            <span class="flex-grow text-right">
                            </span>
                        </a>
                        <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="{{ route('business.product.index') }}">
                            <span class="mx-4 text-lg font-normal">
                                商品一覧
                            </span>
                            <span class="flex-grow text-right">
                            </span>
                        </a>
                        <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="{{ route('business.product.create') }}">
                            <span class="mx-4 text-lg font-normal">
                                商品登録
                            </span>
                            <span class="flex-grow text-right">
                            </span>
                        </a>
                        <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                            <span class="mx-4 text-lg font-normal">
                                アカウント一覧
                            </span>
                            <span class="flex-grow text-right">
                            </span>
                        </a>
                        <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                            <span class="mx-4 text-lg font-normal">
                                管理アカウント一覧
                            </span>
                            <span class="flex-grow text-right">
                            </span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <main class="w-full">
            <div class="container mx-auto px-8 bg-stone-100 h-full">
                <div class="flex justify-center flex-col">
                    <div>
                        <h1 class="text-xl">@yield('title')</h1>
                    </div> 
                    <div>
                        @if($errors->any())
                        <div class="bg-red-200 px-2 py-2 my-4 rounded-md">
                            <p class="px-4 py-2">入力内容を確認してください</p>
                        </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
<script src="{{ asset('js/business/app.js') }}"></script>
@yield('script')
</body>
</html>