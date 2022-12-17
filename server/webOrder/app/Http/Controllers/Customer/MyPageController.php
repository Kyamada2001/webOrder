<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MyPageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOrderHistories(Request $request)
    {
        try{
            $perPage = $request->input('per_page');
            $page = $request->input('page');
            $userId = Auth::guard('customer')->user()->id;
            $orders = Order::with('order_detail')->where('customer_id', $userId)->paginate($perPage, ['*'], 'page', $page);
            Log::info((array)$orders);
            return response()->json([
                'orders' => $orders->items(),
                'total' => $orders->total(),
            ], 200);
        }catch(\Exception $e){
            Log::info($orders);
            Log::error($e);
            return response()->json(['message' => $e], 500);
        }
    }
}