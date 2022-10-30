<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;

    //updateされると注文商品がわからなくなるため、name,price等も入れる
    protected $fillable = [
        'shop_id',
        'product_imgpath',
        'product_id',
        'product_name',
        'product_quantity',
        'product_price',
    ];
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
