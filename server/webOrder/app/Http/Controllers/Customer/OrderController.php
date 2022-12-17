<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Exception;
use DateTime;

class OrderController extends Controller
{
    //ユーザーmiddlewareを入れたい

    //protected $customer;

    public function __construct() {
        $this->customer = Auth::guard('customer')->user();
    }

    public function store(Request $request){
        Log::info($request);

        try{
            DB::beginTransaction();

            $orderDetails = $this->getOrderDetailsProducts($request->cartProducts);
            $order = $this->getOrderInfo($orderDetails, $request);
            $order->save();
            $order->order_detail()->createMany($orderDetails);

            DB::commit();


            $shopIds = explode(',', $order->shop_id);
            $shops = Shop::find($shopIds)->toArray();
        }catch(Exception $e){
            DB::rollBack();
            Log::error($e);
        }

        return response()->json([
            'order' => $order, // orderに店舗情報も入れている
            'customer' =>  Auth::guard('customer')->user(),
            'shops' => $shops,
        ], 200);
    }
    private function getOrderDetailsProducts($cartProducts){
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

        //ここでOrder Details用の配列にサーバー側で取ってきた値を書き込む
        foreach($acquiredProducts as $index => &$acquiredProduct){
            $product = array_filter($productList, function($element) use($acquiredProduct){
                return $element['id'] == $acquiredProduct['product_id'];
            });
            Log::info('$product');
            Log::info($product);
            $product = array_values($product);

            Log::info($product[0]['name']);
            $acquiredProducts[$index]['product_name'] = $product[0]['name'];//本当はArray Filterの時点でIndexなしで取得したい
            $acquiredProducts[$index]['product_price'] = $product[0]['price'];
            $acquiredProducts[$index]['shop_id'] = $product[0]['shop_id'];
            $acquiredProducts[$index]['product_imgpath'] = $product[0]['imgpath'];

            $product = array();
        }
        unset($acquiredProduct);
        

        return $acquiredProducts;
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
    private function getOrderInfo($orderDetails, $request){
        $order = new Order();

        $productShopIds = [];
        //total_amountとtotal_quantityの計算
        foreach($orderDetails as $orderDetailProduct){
            $order->total_quantity += $orderDetailProduct['product_quantity'];
            $order->total_amount += $orderDetailProduct['product_quantity'] * $orderDetailProduct['product_price'];
            array_push($productShopIds, $orderDetailProduct['shop_id']);
        }
        $order->shop_id = implode(',', array_unique($productShopIds));
        //チェックを入れたい
        $order->prepaid_flg = $request['orderInfo']['prepaid_flg'];
        $order->tel = $request['orderInfo']['telephoneNumber'];
        $orderTime = $request['orderInfo']['order_time'];
        $order->acceptance_datetime = date('Y-m-d H:i' ,strtotime($orderTime['year'] .'-' . $orderTime['month'] . '-' . $orderTime['date'] . $orderTime['time']));
        $order->customer_id = Auth::guard('customer')->user()->id;//コンストラクトを呼び出せるようにしたい
        $order->status = Order::NOTYETDELIVERED_STATUS;
        $order->order_time = new DateTime('now');

        //完了画面に表示するため、shop情報を取得。本当はここで取得したくない。設計を要検討

        return $order;
    }
}
