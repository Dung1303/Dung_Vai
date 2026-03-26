@extends('layouts.master')

@section('content')
<h2>Sửa sản phẩm</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $product->name }}"><br><br>
    <input type="number" name="price" value="{{ $product->price }}"><br><br>
    <input type="number" name="stock" value="{{ $product->stock }}"><br><br>

    <select name="category_id">
        @foreach($categories as $c)
        <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
            {{ $c->name }}
        </option>
        @endforeach
    </select>

    <br><br>
    <button type="submit">Cập nhật</button>
</form>
@endsection