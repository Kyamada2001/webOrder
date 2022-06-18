<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function Order(Request $request){
        return response()->json($request);
    }
}
