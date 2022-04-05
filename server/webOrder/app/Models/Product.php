<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shop_id',
        'price',
        'imgpath',
        'recommendation_flg',
    ];

    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }
}
