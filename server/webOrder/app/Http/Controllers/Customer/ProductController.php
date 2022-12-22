<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        try{
            $products = Product::get();
            $shops = Shop::get();
            return response()->json([
                'products' => $products,
                'shops' => $shops,
            ], 200);
        }catch(\Exception $e){
            Log::error($e);
            return response()->json(['message' => $e], 500);
        }
    }
}