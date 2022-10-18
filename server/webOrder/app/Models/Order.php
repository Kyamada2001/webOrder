<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'customer_id',
        'total_amount',
        'order_time',
        'total_quantity',
        'acceptance_datetime',
        'prepaid_flg',
        'status',
        'tel',
    ];
    public function order_detail(){
        return $this->hasMany('App\Models\Order_detail');
    }

    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }
    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }
}
