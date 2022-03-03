<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('shop')->get();
        return view('business.products.index',[
            'products' => $products,
        ]);
    }

    public function create(){
        $shops = Shop::get(); //N+1問題考える。いらないカラムは削除するようにした方が良いかも
        return view('business.products.create',[
            'shops' => $shops,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'sale_shop' => 'required',
            'product_name' =>'required|max:20',
            'product_price' => 'required',
        ]);

        $products = new Product();
        $products->name = $request->product_name;
        $products->shop_id = $request->sale_shop;
        $products->price = $request->product_price;
        $products->save();
        
        return redirect(route('business.product.index'));
    }
}
