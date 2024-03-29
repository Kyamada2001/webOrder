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
<div class="flex flex-row">
    <div id="sidebar" class="h-full">
        <div class="md:flex flex-col animate-slide-in-bck-left" :class="{'hidden': sidebarHidden, 'fixed left-0 top-0 z-50': !sidebarHidden}">
            <div class="text-orange-500 bg-white">
                <h3 v-if="!isMd" class="px-12 py-6 flex-col">webOrder総合管理</h3>
                <div v-else class="h-20"></div>
            </div>
            <div class="bg-gray-800 h-full">
                <div class="flex flex-col sm:flex-row sm:justify-around">
                    <div class="w-72 h-full">
                        <nav class="mt-10 px-6 ">
                            <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-300 dark:text-gray-400 rounded-lg " href="{{ route('business.shop.index') }}">
                                <span class="mx-4 text-lg font-normal">
                                    店舗一覧
                                </span>
                                <span class="flex-grow text-right">
                                </span>
                            </a>
                            <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-300 dark:text-gray-400 rounded-lg " href="{{ route('business.shop.create') }}">
                                <span class="mx-4 text-lg font-normal">
                                    店舗登録
                                </span>
                                <span class="flex-grow text-right">
                                </span>
                            </a>
                            <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-300 dark:text-gray-400 rounded-lg " href="{{ route('business.product.index') }}">
                                <span class="mx-4 text-lg font-normal">
                                    商品一覧
                                </span>
                                <span class="flex-grow text-right">
                                </span>
                            </a>
                            <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-300 dark:text-gray-400 rounded-lg " href="{{ route('business.product.create') }}">
                                <span class="mx-4 text-lg font-normal">
                                    商品登録
                                </span>
                                <span class="flex-grow text-right">
                                </span>
                            </a>
                            <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-300 dark:text-gray-400 rounded-lg " href="{{ route('business.order.index') }}">
                                <span class="mx-4 text-lg font-normal">
                                    注文一覧
                                </span>
                                <span class="flex-grow text-right">
                                </span>
                            </a>
                            <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-300 dark:text-gray-400 rounded-lg " href="{{ route('business.customer.index') }}">
                                <span class="mx-4 text-lg font-normal">
                                    お客様一覧
                                </span>
                                <span class="flex-grow text-right">
                                </span>
                            </a>
                            <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-300 dark:text-gray-400 rounded-lg " href="{{ route('business.user.index') }}">
                                <span class="mx-4 text-lg font-normal">
                                    管理アカウント一覧
                                </span>
                                <span class="flex-grow text-right">
                                </span>
                            </a>
                            <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-300 dark:text-gray-400 rounded-lg " href="{{ route('business.user.create') }}">
                                <span class="mx-4 text-lg font-normal">
                                    管理アカウント登録
                                </span>
                                <span class="flex-grow text-right">
                                </span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="!sidebarHidden" class="fixed w-full h-full bg-gray-900 bg-opacity-50 z-10" @click="sidebarHidden=true"></div>
        <div class="fixed left-0 right-0 mx-4 my-4 w-9 h-9 rounded-sm border-gray-700 border-1" style="z-index: 70;">
            <div v-if="sidebarMdHidden" @click="sidebarHidden = false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </div>
            <div v-if="!sidebarMdHidden && isMd" @click="sidebarHidden = true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>

    </div>
    <div class="w-full">
        <div class="h-20 w-full">
            <header class="relative flex flex-row w-full">
                <div class="flex flex-row absolute inset-y-0 right-0 px-4 py-6">
                    <div class="px-2">
                        {{ Auth::guard('user')->user()->username }}さん
                    </div>
                    <form action="{{ route('business.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-800 hover:text-blue-500 hover:underline">ログアウト</button>
                    </form>
                </div>
            </header>
        </div>
        <main class="w-full">
            <div class="container px-4 md:px-8 bg-stone-100 h-full">
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
</div>
<script src="{{ asset('js/business/app.js') }}"></script>
<script>
new Vue({
    el: '#sidebar',
    data() {
        return {
            sidebarHidden: true,
            isMd: null,
        }
    },
    computed: {
        sidebarMdHidden() {
            return this.isMd && this.sidebarHidden;
        }
    },
    created() {
        this.isMd = (window.innerWidth <= 768);
        const mediaQueryList = window.matchMedia('(min-width: 640px) and (max-width: 768px)');
            mediaQueryList.addListener((event) => {
                console.log("check")
                this.isMd = (window.innerWidth <= 768);
                // if(isMd) this.sidebarHidden = true;
                // else     this.sidebarHidden = false;
            });
    },
    // mounted() {
    //     this.$watch(
    //     () => {
    //         return {
    //         width: window.innerWidth,
    //         height: window.innerHeight
    //         }
    //     },
    //     (newValue, oldValue) => {
            
    //     },
    //     {
    //         deep: true
    //     }
    //     )
    // }
})

</script>
@yield('script')
</body>
</html>