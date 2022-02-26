@extends('business.layouts.app')
@section('title','商品登録')
@section('content')
@if($errors->any())
<div class="bg-red-200 px-2 py-2 my-4 rounded-md">
    <p class="px-4 py-2">入力内容を確認してください</p>
</div>
@endif
<div  class="p-6 bg-white">
    <form action="{{ route('business.product.store') }}" method="post">
        @csrf
        <div class="divide-gray-200">
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>商品名</label>
                </div>
                <div>
                    <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-100 rounded-lg focus:shadow-outline outline-black  @error('shop_name') border-red-400 @enderror"
                            type="text" name="product_name">
                    @if($errors->has('product_name'))
                        @foreach($errors->get('shop_name') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex justify-center py-4">
                <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 border rounded">送信</button>
            </div>
        </div>
    </form>
</div>

@endsection