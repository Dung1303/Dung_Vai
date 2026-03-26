@extends('layouts.master')

@section('content')
<h2>Thêm sản phẩm</h2>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Tên"><br><br>
    <input type="number" name="price" placeholder="Giá"><br><br>
    <input type="number" name="stock" placeholder="Tồn"><br><br>

    <select name="category_id">
        @foreach($categories as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>

    <br><br>
    <button type="submit">Lưu</button>
</form>
@endsection