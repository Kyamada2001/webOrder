@extends('business.layouts.app')
@section('title','注文一覧')
@section('content')
<div id="app" class="p-1 md:p-6 bg-white">
    <div class="p-1 md:p-6 bg-white">
        <div class="pb-2">
            <p>全{{ count($orders) }}件</p>
        </div>
        <div>
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <td class="thead-item">ID</td>
                        <td class="thead-item">店舗名</td>
                        <td class="thead-item">注文金額</td>
                        <td class="thead-item">受渡日時</td>
                    </tr>
                </thead>
                @foreach($orders as $order)
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-3 px-1 text-sm font-medium text-sky-400 whitespace-nowrap dark:text-sky-400 hover:underline decoration-solid">{{ $order->id }}</td>
                        @php
                            $orderShopIds = explode(',', $order->shop_id);
                        @endphp
                        <td class="py-3 px-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @foreach($orderShopIds as $shopId)
                            @if(!$loop->first) </br> @endif
                            {{ $shops[$shopId]["name"] }}
                        @endforeach
                        </td>
                        <td class="py-3 px-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $order->total_amount }}円</td>
                        <td class="py-3 px-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $order->acceptance_datetime }}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection