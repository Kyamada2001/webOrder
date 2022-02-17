<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/business/app.css') }}" rel="stylesheet">
    <title>web管理</title>
</head>
<body>
    <div class="flex flex-row">
        <div>
            <div class="relative dark:bg-gray-800 h-full w-2/6">
                    <div class="flex flex-col sm:flex-row sm:justify-around">
                        <div class="w-72 h-screen">
                            <nav class="mt-10 px-6 ">
                                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                                    <span class="mx-4 text-lg font-normal">
                                        Element
                                    </span>
                                    <span class="flex-grow text-right">
                                    </span>
                                </a>
                                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                                    <span class="mx-4 text-lg font-normal">
                                        Form
                                    </span>
                                    <span class="flex-grow text-right">
                                    </span>
                                </a>
                                <a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                                    <span class="mx-4 text-lg font-normal">
                                        Commerce
                                    </span>
                                    <span class="flex-grow text-right">
                                    </span>
                                </a>
                                <!--a class="hover:text-gray-800 hover:bg-gray-100 flex items-center p-2 my-6 transition-colors dark:hover:text-white dark:hover:bg-gray-600 duration-200  text-gray-600 dark:text-gray-400 rounded-lg " href="#">
                                    <span class="mx-4 text-lg font-normal">
                                        Navigation
                                    </span>
                                    <span class="flex-grow text-right">
                                    </span>
                                </a-->
                            </nav>
                        </div>
                    </div>
            </div>
        </div>

        <div class="container mx-auto px-8 bg-stone-100">
            <div class="flex justify-center flex-col">
                <div>
                    <h1>店舗一覧</h1>
                </div> 
                <div class="flex justify-center">
                    <a class="mx-2 my-2 bg-white transition duration-150 ease-in-out hover:bg-gray-100 hover:text-dark-600 rounded border border-indigo-700 text-blue-700 px-6 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700" href="#">
                        新規登録
                    </a>
                    <a class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 border rounded" href="#">
                        新規登録
                    </a>
                </div>
                <div class="p-6 bg-white overflow-x-auto">
                        <div>
                            <p>全{{ count($shops) }}件</p>
                        </div>
                    <table class="min-w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <td class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">店舗ID</td>
                                <td class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">店舗名</td>
                                <td class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">営業時間(開店時間)</td>
                                <td class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">営業時間(閉店時間)</td>
                                <td class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">週休</td>
                            </tr>
                        </thead>
                        @foreach($shops as $shop)
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $shop->id }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $shop->name }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $shop->business_start_time }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $shop->business_end_time }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex flex-row">
                                    @foreach(str_split($shop->weekly_holiday) as $holiday)
                                        @switch($holiday)
                                            @case(App\Models\Shop::STATUS_NO_HOLIDAY)
                                                @break
                                                <div class="bg-red-400 text-white font-bold py-1 px-2 rounded-full">週休なし</div>
                                            @case(App\Models\Shop::STATUS_MONDAY)
                                                <div class="bg-red-500 text-white font-bold py-1 px-2 rounded-full">月</div>
                                                @break
                                            @case(App\Models\Shop::STATUS_TUESDAY)
                                                <div class="bg-red-500 text-white font-bold py-1 px-2 rounded-full">火</div>
                                                @break
                                            @case(App\Models\Shop::STATUS_WEDNESDAY)
                                                <div class="bg-red-400 text-white font-bold py-1 px-2 rounded-full">水</div>
                                                @break
                                            @case(App\Models\Shop::STATUS_THURSDAY)
                                                <div class="bg-amber-500 text-white font-bold py-1 px-2 rounded-full">木</div>
                                                @break
                                            @case(App\Models\Shop::STATUS_FRIDAY)
                                                <div class="bg-red-400 text-white font-bold py-1 px-2 rounded-full">金</div>
                                                @break
                                            @case(App\Models\Shop::STATUS_SATURDAY)
                                                <div class="bg-red-400 text-white font-bold py-1 px-2 rounded-full">土</div>
                                                @break
                                            @case(App\Models\Shop::STATUS_SUNDAY)
                                                <div class="bg-red-400 text-white font-bold py-1 px-2 rounded-full">日</div>
                                                @break
                                            @default
                                                <div class="bg-red-400 text-white font-bold py-1 px-2 rounded-full">不定期</div>
                                        @endswitch
                                    @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>