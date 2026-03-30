<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class TrangChuController extends Controller
{
   public function index(Request $request)
{
    $query = Product::with('category');

    // 🔍 Tìm theo tên
    if ($request->keyword) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    // 📂 Lọc theo category
    if ($request->category) {
        $query->where('category_id', $request->category);
    }

    // 💰 Lọc theo giá tối đa
    if ($request->price) {
        $query->where('price', '<=', $request->price);
    }

    // 🔽 Sắp xếp
    if ($request->sort == 'price_asc') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort == 'price_desc') {
        $query->orderBy('price', 'desc');
    }

    $products = $query->get();

    // Lấy categories để đổ dropdown
    $categories = \App\Models\Category::all();

    return view('trangchu', compact('products', 'categories'));
}
}