<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Customer extends Authenticatable //ログインの判別をするテーブルのモデルはAuthenticatableを継承する
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function order(){
        return $this->hasMany('App\Models\Order');
    }
}
