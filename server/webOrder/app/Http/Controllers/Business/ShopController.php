<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    private $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;        
    }


    public function index(){

        $shops = Shop::get();
        //dd($shops);
        foreach($shops as $shop){ //もっといい処理あるかも
            $shop->weekly_holiday = str_replace(',', '', $shop->weekly_holiday);
            $shop->business_start_time = substr($shop->business_start_time, 0,5);
            $shop->business_end_time = substr($shop->business_end_time, 0,5);
        }
        return view('business.shops.index',[
            'shops' => $shops,
        ]);
    }

    public function create(){
        $shop = $this->shop;
        return view('business.shops.create', [
            'shop' => $shop,
        ]);
    }
}
