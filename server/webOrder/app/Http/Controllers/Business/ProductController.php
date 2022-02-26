<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('shop')->get();
        return view('business.products.index',[
            'products' => $products,
        ]);
    }

    public function create(){
        return view('business.products.create');
    }

    public function store(Request $request){
        
    }
}
