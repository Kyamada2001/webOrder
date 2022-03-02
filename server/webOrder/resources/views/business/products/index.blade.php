@extends('business.layouts.app')
@section('title', '商品一覧')
@section('content')
<div id="app" class="p-6 bg-white">
    <div class="flex justify-center">
        <a class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 border rounded" href="{{ route('business.product.create') }}">
            新規登録
        </a>
    </div>
    <div class="p-6 bg-whitez">
        <div>
            <p>全{{ count($products) }}件</p>
        </div>
        <div>
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <td class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">商品ID</td>
                        <td class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">販売店舗</td>
                        <td class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">商品名</td>
                        <td class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">商品金額</td>
                    </tr>
                </thead>
                @foreach($products as $product)
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->id }}</td>
                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->shop->name }}</td>
                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->name }}</td>
                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->price }}円</td>
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