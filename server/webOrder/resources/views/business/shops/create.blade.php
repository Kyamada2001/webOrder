@extends('business.layouts.app')
@section('title', '店舗登録')
@section('content')
<div  class="p-6 bg-white">
    <form>
        <div>
            <div class="flex flex-row py-3">
                <div class="w-1/4">
                    <label>店舗名</label>
                </div>
                <div>
                    <input type="text" value="{{ $shop->name }}">
                </div>
            </div>
            <div class="flex flex-row py-3">
                <div class="w-1/4">
                    <label>営業時間</label>
                </div>
                <div>
                    <vue-timepicker 
                        format="HH:mm"
                        minute-interval="15"
                        name="business_start_time">
                    </vue-timepicker>
                    <label>〜</label>
                    <vue-timepicker
                        format="HH:mm"
                        minute-interval="15"
                        name="business_end_time">
                    </vue-timepicker>
                </div>
            </div>
            <div class="flex flex-row py-3">
                <div class="w-1/4">
                    <label>定休日</label>
                </div>
                <div>
                    <weekly-holiday-select-component holiday="@json($shop->weekly_holiday)">
                    </weekly-holiday-select-component>
                </div>
            </div>
            <div class="flex justify-center">
                <a class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 border rounded" href="{{ route('shop.store') }}">送信</a>
            </div>
        </div>
    </form>
</div>

@endsection

@section('script')
@endsection