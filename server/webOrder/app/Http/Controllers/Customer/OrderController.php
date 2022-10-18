<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request){
        return response()->json($request);
    }

    public function create(Request $request){
        //Request情報チェックを入れたい。
        //shopIDはカンマ区切りで保存する必要あり

        $customer = Auth::guard('customer')->user();
        Log::info($customer);

        DB::beginTransaction();

        $order = new Order();
        $order->customer_id = $customer->id;
        //$order->shop_id = //shop_idいらないかも
        #

        //DBのカラム名と合わせたい
        $orderDetails = array();
        foreach($request->cartProducts as $index => $cartProdcut){
            $orderDetails[$index]->product_id = $cartProdcut->id;
            $orderDetails[$index]->product_name = $cartProduct->name;//product Nameはなくてもいい？
        }
        $order->order_detail()->createMany();

        DB::commit();

        return response()->json($customer, 200);
    }
}
