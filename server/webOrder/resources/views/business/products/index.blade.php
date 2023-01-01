@extends('business.layouts.app')
@section('title', '商品一覧')
@section('content')
<div id="app" class="p-1 md:p-6 bg-white">
    <div class="flex justify-center">
        <a class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 border rounded" href="{{ route('business.product.create') }}">
            新規登録
        </a>
    </div>
    <div class="p-1 md:p-6 bg-white">
        <div>
            <p>全{{ count($products) }}件</p>
        </div>
        <div class="box-border">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <td class="thead-item">商品ID</td>
                        <td class="thead-item">商品名</td>
                        <td class="thead-item">商品画像</td>
                        <td class="thead-item">販売店舗</td>
                        <td class="thead-item">商品金額</td>
                        <td class="thead-item">おすすめ</td>
                    </tr>
                </thead>
                @foreach($products as $product)
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-1 md:px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->id }}</td>
                        <td class="py-4 px-1 md:px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-sky-400 hover:underline decoration-solid"><a href="{{ route('business.product.edit', ['product' => $product]) }}">{{ $product->name }}</a></td>
                        <td class="py-4 px-1 md:px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if(!empty($product->imgpath))
                            <img class="h-24 w-28 object-cover" src="{{ asset('storage/' . $product->imgpath) }}">
                            @else
                            <img class="h-24 w-28 object-cover" src="{{ asset('storage/images/noimage.png') }}">
                            @endif
                        </td>
                        <td class="py-4 px-1 md:px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->shop->name }}</td>
                        <td class="py-4 px-1 md:px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->price }}円</td>
                        <td class="py-4 px-1 md:px-3 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if($product->recommendation_flg == 1)
                            <label class="text-sm bg-orange-400 text-white font-bold py-1 px-2 rounded-full text-center">おすすめ</label>
                            @else
                            <label>ー</label>
                            @endif
                        </td>
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