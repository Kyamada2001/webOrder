@extends('business.layouts.app')
@section('title','店舗一覧')
@section('content')
<div class="p-6 bg-white">
    <div class="flex justify-center">
        <a class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 border rounded" href="{{ route('business.shop.create') }}">
            新規登録
        </a>
    </div>
    <div class="p-6 bg-whitez">
        <div>
            <p>全{{ count($shops) }}件</p>
        </div>
        <div>
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
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection