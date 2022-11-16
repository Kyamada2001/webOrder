<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'product_price' => 'required|numeric',
            'product_image' => 'image|file',
        ]);

        DB::beginTransaction();
        try{
            $imgpath = null;
            if(isset($request->product_image)){
                $fileName = Carbon::now()->format('Ymdms')  . '_' . $request->product_image->getClientOriginalName();
                $imgpath = $request->product_image->storeAs('images/products', $fileName, 'public');
            }
            $product = new Product();
            $product->name = $request->product_name;
            $product->shop_id = $request->sale_shop;
            $product->price = $request->product_price;
            $product->recommendation_flg = $request->recommendation_flg ? $request->recommendation_flg : '';
            $product->imgpath = $imgpath;
            $product->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            if(!empty($imgpath) && Storage::disk('public')->exists($imgpath)) Storage::disk('public')->delete($imgpath);
            Log::info($e);
        }
        return redirect(route('business.product.index'));
    }

    public function edit(Product $product){
        $product = Product::find($product->id);
        $shops = Shop::get();
        return view('business.products.edit',[
            'product' => $product,
            'shops' => $shops,
        ]);
    }

    public function update(Request $request ,Product $product){
        $validated = $request->validate([
            'sale_shop' => 'required',
            'product_name' =>'required|max:20',
            'product_price' => 'required|numeric',
            'product_image' => 'image|file',
        ]);
        $data = $product;
        DB::beginTransaction();
        try{
            $updateImgpath = null;
            
            $product = Product::find($data->id);
            $product->name = $request->product_name;
            $product->shop_id = $request->sale_shop;
            $product->price = $request->product_price;
            $product->recommendation_flg = $request->recommendation_flg ? $request->recommendation_flg : '';
            if(isset($request->product_image)){
                $fileName = Carbon::now()->format('Ymdms')  . '_' . $request->product_image->getClientOriginalName();
                $updateImgpath = $request->product_image->storeAs('images/products', $fileName, 'public');
                $beforeImgpath = $data->imgpath;
                $product->imgpath = $updateImgpath;
            }
            $product->save();
            DB::commit();
            if(!empty($updateImgpath) && Storage::disk('public')->exists($beforeImgpath)) Storage::disk('public')->delete($beforeImgpath);
        }catch(\Exception $e){
            DB::rollBack();
            if(!empty($updateImgpath) && Storage::disk('public')->exists($updateImgpath)) Storage::disk('public')->delete($updateImgpath);
            Log::info($e);
        }
        return redirect(route('business.product.index'));
    }
}
