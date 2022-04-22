@extends('business.layouts.app')
@section('title', '店舗編集')
@section('content')
<div id="app" class="p-6 bg-white">
    <form action="{{ route('business.shop.update', ['shop' => $shop]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="divide-gray-200">
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>店舗名</label>
                </div>
                <div>
                    <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-400 rounded focus:shadow-outline outline-gray-400  @error('shop_name') border-red-400 @enderror"
                            type="text" name="shop_name" value="{{ old('shop_name', $shop->name) }}">
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
                        <vue-timepicker-complete
                        :data="{{ json_encode([
                            'name' => 'business_start_time',
                            'time' => old('business_start_time', $shop->business_start_time) ]) }}">
                        </vue-timepicker-complete>
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
                        <vue-timepicker-complete
                        :data="{{ json_encode([
                            'name' => 'business_end_time',
                            'time' => old('business_end_time', $shop->business_end_time) ]) }}">
                        </vue-timepicker-complete>
                        @if($errors->has('business_end_time'))
                            @foreach($errors->get('business_end_time') as $error)
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @php
                $selectName = 'weekly_holidays';
                $arrayHoliday = explode(',', old($selectName, $shop->weekly_holiday));
            @endphp
            <div class="flex flex-row py-6 border-b-2">
                <div class="px-3 w-1/4">
                    <label>定休日</label>
                </div>
                <div class="w-1/2">
                    <vueform-multiselect-component
                    :value="{{ json_encode($arrayHoliday) }}"
                    :name="{{ json_encode($selectName) }}"></vueform-multiselect-component>
                    @if($errors->has('weekly_holidays'))
                        @foreach($errors->get('weekly_holidays') as $error)
                        <div class="text-red-500 text-xs italic mb-3">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
            <div class="flex flex-row py-3 border-b-2">
                <div class="px-3 w-1/4">
                    <label>店舗画像</label>
                </div>
                <div class="space-y-2">
                    <div class="text-sm">
                        <label>現在登録している画像</label>
                    </div>
                    <div>
                        @isset($shop->imgpath)
                            <img class="h-36 w-36 border object-cover" src="{{ asset('storage/' . $shop->imgpath) }}">
                        @else
                            <img class="h-36 w-36 border object-cover" src="{{ asset('storage/' . 'images/noimage.png') }}">
                        @endisset
                    </div>
                    <input type="file" name="shop_image">
                    @if($errors->has('shop_image'))
                        @foreach($errors->get('shop_image') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
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