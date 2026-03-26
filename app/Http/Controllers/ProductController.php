<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
     // FORM THÊM
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // LƯU
    public function store(Request $request)
    {
        Product::create($request->all());

        return redirect('/trangchu')->with('success', 'Thêm thành công');
    }

    // FORM SỬA
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect('/trangchu')->with('success', 'Cập nhật thành công');
    }

    // DELETE
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('/trangchu')->with('success', 'Xóa thành công');
    }
}