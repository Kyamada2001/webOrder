<?php

namespace App\Http\Controllers\Business;

use Carbon\Carbon;
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

    public function store(Request $request){
        $validated = $request->validate([
            'shop_name' =>'required|max:20',
            'business_start_time' =>'required',
            'business_end_time' =>'required',
            'weekly_holidays' =>'required',
            'shop_image' => 'image|file',
        ]);
        $imgpath = null;
        if(isset($request->shop_image)){
            $fileName = Carbon::now()->format('Ymd')  . '_' . $request->shop_image->getClientOriginalName();
            $imgpath = $request->shop_image->storeAs('images/shops', $fileName, 'public');
        }

        $shop = new Shop();
        $shop->name = $request->shop_name;
        $shop->business_start_time = $request->business_start_time;
        $shop->business_end_time = $request->business_end_time;
        $shop->weekly_holiday = $request->weekly_holidays;
        $shop->imgpath = $imgpath;
        $shop->save();
        return redirect(route('business.shop.index'));
    }

    public function edit(Shop $shop){
        $shop = Shop::find($shop->id);

        return view('business.shops.edit', [
            'shop' => $shop,
        ]);
    }
}
