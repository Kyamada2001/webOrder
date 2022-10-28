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
use App\Models\Product;
use Exception;

class OrderController extends Controller
{
    //ユーザーmiddlewareを入れたい
    public function store(Request $request){
        $customer = Auth::guard('customer')->user();
        Log::info($request);

        try{
            DB::beginTransaction();

            $order = new Order();
            $order->customer_id = $customer->id;
            $products = $this->getCartProducts($request->cartProducts);
            
            //再計算するべき。
            //$order->shop_id = //shop_idいらないかも

            //DBのカラム名と合わせたい
            $orderDetails = array();
            foreach($request->cartProducts as $index => $cartProduct){
                Log::info($cartProduct);
                $orderDetail = [
                    'product_id' => $cartProduct['id'],
                    'product_name' => $cartProduct['name'],//product Nameはなくてもいい？
                    'product_quantity' => $cartProduct['modalInput']['quantity'], //ベストプラクティス的にはmodal_input?
                    'product_price' => $cartProduct['price'],
                ];
                array_push($orderDetails, $orderDetail);
            }
            Log::info("orderDetails");
            Log::info($orderDetails);
            $order->order_detail()->createMany($orderDetails);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            Log::info($e);
        }

        return response()->json($customer, 200);
    }
    private function getCartProducts($cartProducts){
        //product取得
        $productIds = [];
        $acquiredProducts = [];
        foreach($cartProducts as $index => $cartProduct){
            //商品の在庫等のチェック
            if(!$this->productCheck($cartProduct)) return response()->json("不正なデータ",500);

            //ここでOrder Details用の配列にProduct ID等のカラムを追加している
            else{
                $acquiredProducts[$index]['product_id'] = $cartProduct['id'];// Order_detail.phpのfillableとプロパティ名を合わせる
                $acquiredProducts[$index]['product_quantity'] = $cartProduct['modalInput']['quantity'];

                array_push($productIds, $cartProduct['id']);// 同じProducts.idは弾きたい
            }
        }
        $productList = Product::find($productIds)->toArray();
        // 本当はForeachではなく、関数で配列に代入したい
        //　Ordersの情報もここで計算する。TotalQuantityとか

        //ここでOrder Details用の配列にProduct Name等のカラムを追加している
        foreach($acquiredProducts as $index => $acquiredProduct){
            $product = array_filter($productList, function($element) use($acquiredProduct){
                return $element['id'] == $acquiredProduct['product_id'];
            });
            $acquiredProduct['product_name'] = $product[0]['name'];//本当はArray Filterの時点でIndexなしで取得したい
            $acquiredProduct['product_price'] = $product[0]['price'];
        }
    }
    public function productCheck($productInfo){
        try{
            //数量チェック  正常な数値かどうか
            if(!is_int($productInfo['modalInput']['quantity'])) throw new Exception();

            //在庫チェック(実装できたら入れたい)

            //1人あたりの注文上限数チェック(実装できたら入れたい)
        }catch(Exception $e){
            Log::error($e);
        }
        return true;
    }
}
