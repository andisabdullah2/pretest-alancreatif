<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ListController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('produk.index', compact('products'));
    }
}   
