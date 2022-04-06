@extends('business.layouts.app')
@section('title','商品登録')
@section('content')
<div id="app" class="p-6 bg-white">
    <form action="{{ route('business.product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="divide-gray-200">
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>販売店舗</label>
                </div>
                <div>
                <select class="block appearance-none w-full bg-white border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none @error('sale_shop') border-red-400 @enderror"
                        name="sale_shop">
                    <option selected value="">選択してください</option>
                    @foreach($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->id }} {{ $shop->name }}</option>
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
                            type="text" name="product_name">
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
                    <product-price-component></product-price-component>
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
                <div>
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
                    <input class="form-checkbox h-5 w-5 text-indigo-600" value="1" {{ old('recommendation_flg') == '1' ? 'checked' : ''}} type="checkbox" name="recommendation_flg">
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