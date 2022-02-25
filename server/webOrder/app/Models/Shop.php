<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'business_start_time',
        'business_end_time',
        'weekly_holiday'
    ];
    
    /*public function toArray(){
        $shops = Shop::toArray();
        $shops['business_start_time'] = $shops['business_start_time']->format('H:i');
        $shops['business_end_time'] = $shops['business_end_time']->format('H:i');
        return $shops;
    }*/
    const STATUS_NO_HOLIDAY = 0;
    const STATUS_MONDAY = 1;
    const STATUS_TUESDAY = 2;
    const STATUS_WEDNESDAY = 3;
    const STATUS_THURSDAY = 4;
    const STATUS_FRIDAY = 5;
    const STATUS_SATURDAY = 6;
    const STATUS_SUNDAY = 7;

    public function product(){
        return $this->hasMany('App\Models\Product');
    }

    public function order(){
        return $this->hasMany('App\Models\Order');
    }
}

