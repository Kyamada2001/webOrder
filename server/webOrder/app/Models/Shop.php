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

    const STATUS_MONDAY = 1;
    const STATUS_TUSEDAY = 2;
    const STATUS_WEDNESDAY = 3;
    const STATUS_TUESDAY = 4;
    const STATUS_FRIDAY = 5;
    const STATUS_SATURDAY = 6;
    const STATUS_SUNDAY = 7;

    public function products(){
        return $this->hasMany('App\Models\Product');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
}

