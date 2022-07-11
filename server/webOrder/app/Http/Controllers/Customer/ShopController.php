<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DateTime;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class ShopController extends Controller
{
    public function index(){
        $shops = Shop::get();
        return response()->json(['shops' => $shops] ,200);
    }

    public function getShopDetail(Request $request){
        $shopDetails = Shop::with('product')->find($request->shopId);
        return response()->json(['shopDetails' => $shopDetails], 200);
    }

    public function getReservableDateTime(Request $request){
        //やること1：週休で注文不可フラグをつける
        //やること2：注文不可フラグをつけた日付にはtimeListに文言を追加する？検討中

        //request: shop_id
        //2週間以内で予約可能な日にち、時間を取得するAPI
        $shop = Shop::find($request->shop_id);

        $start = 0; //開始日
        $end = 13; //終了日（14日後）
        $dateTimes = array();

        //店舗の注文可能時間を出している
        $orderAbleTime = new DateTime($shop->business_start_time);
        $orderAcceptanceEndTime = new DateTime($shop->business_end_time);

        //timeList(営業時間リスト)を先に作ってしまう
        $orderReceptionTime = [];
        for($t = clone $orderAbleTime; $t <= $orderAcceptanceEndTime; $t->modify('+30 min')){ //DateIntervalにした方が良かったとおもふ
            array_push($orderReceptionTime, $t->format('H:i'));
        }

        for($i = $start; $i <= $end; $i++){
            $dateTime = new DateTime('+'.$i.' day');

            //joinDateさえあったらyear,month等はいらないかも
            $dateTimes[$i] = [
                'year' => $dateTime->format('Y'),
                'month' => $dateTime->format('m'),
                'date' => $dateTime->format('d'),
                'dayOfWeek' => $dateTime->format('w'),
                'joinDate' => $dateTime->format('Y年m月d日'),                
            ];
            
            //週休該当日か判定
            $shopWeeklyHolidays = explode(',', $shop->weekly_holiday);
            if(in_array($dateTime->format('w'), $shopWeeklyHolidays)){
                $dateTimes[$i] += array('timeList' => ['定休日です。'], 'orderAbleFlg' => Shop::ORDER_IMPOSSIBLE_FLG);
            }else{
                if($i === $start){ //今日かどうか判定
                    if($orderAbleTime > $dateTime) $dateTimes[$i] += array('timeList' => $orderReceptionTime, 'orderAbleFlg' => Shop::ORDER_POSSIBLE_FLG);//現在時間が営業開始時間より前の場合
                    elseif($orderAcceptanceEndTime < $dateTime) $dateTimes[$i] += array('timeList' =>['営業時間が終了しました。'], 'orderAbleFlg' => Shop::ORDER_IMPOSSIBLE_FLG); //現在時間が営業時間終了時間より後の場合
                    else { //営業時間内の場合
                        //現在時間より後の注文可能時間を取得
                        $separation = 30;
                        $roundUpMin = $separation - ((int) $dateTime->format('i') - $separation);
                        $dateTime->modify('+'.$roundUpMin.' min');
                        $todayOrderReceptionTimeList = [];
                        for($t = clone $dateTime; $t <= $orderAcceptanceEndTime; $t->modify('+30 min')){
                            array_push($todayOrderReceptionTimeList, $t->format('H:i'));
                        }
                        $dateTimes[$i] += array('timeList' => $todayOrderReceptionTimeList, 'orderAbleFlg' => Shop::ORDER_POSSIBLE_FLG);
                    }
                }else{
                    $dateTimes[$i] += array('timeList' => $orderReceptionTime, 'orderAbleFlg' => Shop::ORDER_POSSIBLE_FLG);
                }
            }
        }
        return response()->json(['dateTimes' => $dateTimes], Response::HTTP_OK);

    }
}
