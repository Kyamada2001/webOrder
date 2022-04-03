<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(){
        $shops = Shop::get();
        return response()->json(['shops' => $shops] ,200);
    }
}
