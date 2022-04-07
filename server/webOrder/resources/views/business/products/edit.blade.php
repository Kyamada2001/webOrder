@extends('business.layouts.app')
@section('title','商品登録')
@section('content')
<div id="app" class="p-6 bg-white">
    <form action="{{ route('business.product.update',['product' => $product]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="divide-gray-200">
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>販売店舗</label>
                </div>
                <div>
                <select class="block appearance-none w-full bg-white border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none @error('sale_shop') border-red-400 @enderror"
                        name="sale_shop"
                        value="{{ $product->shop->id }}">
                    <option selected value="">選択してください</option>
                    @foreach($shops as $shop)
                    <option value="{{ $shop->id }}" 
                    @if(old('sale_shop', $product->shop->id) == $shop->id) selected  @endif
                    >{{ $shop->id }} {{ $shop->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('sale_shop'))
                        @foreach($errors->get('sale_shop') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>商品名</label>
                </div>
                <div>
                    <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-100 rounded-lg focus:shadow-outline outline-black  @error('product_name') border-red-400 @enderror"
                            type="text" name="product_name" value="{{ old('product_name',$product->name) }}">
                    @if($errors->has('product_name'))
                        @foreach($errors->get('product_name') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>商品金額</label>
                </div>
                <div>
                    <product-price-component
                    :data="{{ json_encode([
                        'price' => old('product_price', $product->price)]) }}"></product-price-component>
                    @if($errors->has('product_price'))
                        @foreach($errors->get('product_price') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>商品画像</label>
                </div>
                <div class="space-y-2">
                    <div class="text-sm">
                        <label>現在登録している画像</label>
                    </div>
                    <div>
                        @isset($product->imgpath)
                            <img class="h-36 w-auto border" src="{{ asset('storage/' . $product->imgpath) }}">
                        @else
                            <img class="h-36 w-auto border" src="{{ asset('storage/' . 'images/noimage.png') }}">
                        @endisset
                    </div>
                    <input type="file" name="product_image">
                    @if($errors->has('product_image'))
                        @foreach($errors->get('product_image') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>おすすめ設定</label>
                </div>
                <div>
                    <input class="form-checkbox h-5 w-5 text-indigo-600" 
                    value="1" 
                    type="checkbox" 
                    name="recommendation_flg"
                    {{ old('recommendation_flg', $product->recommendation_flg) == '1' ? 'checked' : ''}}
                    >
                    @if($errors->has('recommendation_flg'))
                        @foreach($errors->get('recommendation_flg') as $error)
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
@section('script')

@endsection