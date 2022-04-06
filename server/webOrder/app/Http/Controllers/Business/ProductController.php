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
            if(isset($request->product_image)){
            $fileName = Carbon::now()->format('Ymdhms')  . '_' . $request->product_image->getClientOriginalName();
            Image::make($request->product_image)->resize(150,150)->save(storage_path('app/public/images/products/') . $fileName);
            $imgpath = 'images/products/' . $fileName;
        }
        $products = new Product();
        $products->name = $request->product_name;
        $products->shop_id = $request->sale_shop;
        $products->price = $request->product_price;
        $products->recommendation_flg = $request->recommendation_flg ? $request->recommendation_flg : '';
        $products->imgpath = $imgpath;
        $products->save();
        DB::commit();
        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
            if(!empty($imgpath) && Storage::disk('public')->exists($imgpath)) Storage::disk('public')->delete($imgpath);
            throw $e;
        }
        return redirect(route('business.product.index'));
    }
}
