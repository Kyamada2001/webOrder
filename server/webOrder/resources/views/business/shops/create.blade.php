@extends('business.layouts.app')
@section('title', '店舗登録')
@section('content')
<div  class="p-6 bg-white">
    <form>
        <div>
            <div>
                <label>店舗名</label>
                <input type="text">
            </div>
            <div>
                <label>営業時間</label>
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
    </form>
</div>

@endsection

@section('script')
@endsection