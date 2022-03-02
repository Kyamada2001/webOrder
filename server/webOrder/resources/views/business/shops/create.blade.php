@extends('business.layouts.app')
@section('title', '店舗登録')
@section('content')
<div  id="app" class="p-6 bg-white">
    <form action="{{ route('business.shop.store') }}" method="post">
        @csrf
        <div class="divide-gray-200">
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>店舗名</label>
                </div>
                <div>
                    <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-400 rounded-lg focus:shadow-outline outline-gray-400  @error('shop_name') border-red-400 @enderror"
                            type="text" name="shop_name" value="{{ old('name', $shop->name) }}">
                    @if($errors->has('shop_name'))
                        @foreach($errors->get('shop_name') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex flex-row py-7 border-b-2">
                <div class="px-3 w-1/4">
                    <label>営業時間</label>
                </div>
                <div class="flex flex-row">
                    <div>
                        <vue-timepicker 
                            format="HH:mm"
                            minute-interval="15"
                            name="business_start_time">
                        </vue-timepicker>
                        @if($errors->has('business_start_time'))
                            @foreach($errors->get('business_start_time') as $error)
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                    <div class="px-2 py-2">
                        <label>〜</label>
                    </div>
                    <div>
                        <vue-timepicker
                            format="HH:mm"
                            minute-interval="15"
                            name="business_end_time">
                        </vue-timepicker>
                        @if($errors->has('business_end_time'))
                            @foreach($errors->get('business_end_time') as $error)
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-row py-6 border-b-2">
                <div class="px-3 w-1/4">
                    <label>定休日</label>
                </div>
                <div class="w-1/2">
                    <vueform-multiselect-component></vueform-multiselect-component>
                    @if($errors->has('weekly_holidays'))
                        @foreach($errors->get('weekly_holidays') as $error)
                        <div class="text-red-500 text-xs italic mb-3">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
            
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