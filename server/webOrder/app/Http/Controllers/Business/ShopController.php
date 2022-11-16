<?php

namespace App\Http\Controllers\Business;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Shop;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    private $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;        
    }


    public function index(){

        $shops = Shop::get();
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

    public function store(Request $request, Shop $shop){
        $validated = $request->validate([
            'shop_name' =>'required|max:40',
            'business_start_time' =>'required|regex:/\d{2}:\d{2}$/',
            'business_end_time' =>'required|regex:/\d{2}:\d{2}$/',
            'weekly_holidays' =>'required',
            'shop_image' => 'image|file',
        ]);
        $imgpath = null;

        DB::beginTransaction();
        try{
            if(isset($request->shop_image)){
                $fileName = Carbon::now()->format('Ymdms')  . '_' . $request->shop_image->getClientOriginalName();
                $imgpath = $request->shop_image->storeAs('images/shops', $fileName, 'public');
            }
            $shop = new Shop();
            $shop->name = $request->shop_name;
            $shop->business_start_time = $request->business_start_time;
            $shop->business_end_time = $request->business_end_time;
            $shop->weekly_holiday = $request->weekly_holidays;
            $shop->imgpath = $imgpath;
            $shop->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            if(Storage::disk('public')->exists($imgpath)) Storage::disk('public')->delete($imgpath);
            Log::info($e);  
        }

        return redirect(route('business.shop.index'));
    }

    public function edit(Shop $shop){
        $shop->business_start_time = substr($shop->business_start_time, 0,5);
        $shop->business_end_time = substr($shop->business_end_time, 0,5);
        return view('business.shops.edit', [
            'shop' => $shop,
        ]);
    }

    public function update(Request $request,Shop $shop){
        //dd($request);
        $validated = $request->validate([
            'shop_name' =>'required|max:40',
            'business_start_time' =>'required|regex:/\d{2}:\d{2}$/',
            'business_end_time' =>'required|regex:/\d{2}:\d{2}$/',
            'weekly_holidays' =>'required',
            'shop_image' => 'image|file',
        ]);

        DB::beginTransaction();
        try{
            $data = Shop::find($shop->id);
            $data->name = $request->shop_name;
            $data->business_start_time = $request->business_start_time;
            $data->business_end_time = $request->business_end_time;
            $data->weekly_holiday = $request->weekly_holidays;
            if(isset($request->shop_image)){
                $fileName = Carbon::now()->format('Ymdms')  . '_' . $request->shop_image->getClientOriginalName();
                $updateImgpath = $request->shop_image->storeAs('images/shops', $fileName, 'public');
                $beforeImgpath = $data->imgpath;
                $data->imgpath = $updateImgpath;
            }
            $data->save();
            DB::commit();
            if(isset($request->shop_image)) Storage::disk('public')->delete($beforeImgpath);
        }catch(\Exception $e){
            //画像削除できなかった場合は新しく登録した画像を削除
            DB::rollBack();
            if(!empty($updateImgpath) && Storage::disk('public')->exists($updateImgpath)) Storage::disk('public')->delete($updateImgpath);
            Log::info($e);
        }
        return redirect(route('business.shop.index'));
    }
}
