<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class TrangChuController extends Controller
{
   public function index()
{
    // Lấy sản phẩm + category
    $products = Product::with('category')->get();

    return view('trangchu', compact('products'));
}
}