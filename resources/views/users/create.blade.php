@extends('layouts.auth_master')

@section('content')
<div class="container" style="padding: 20px;">
    <h2>Thêm người dùng mới</h2>
    <hr>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 10px;">
            <label>Họ tên:</label><br>
            <input type="text" name="name" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Email:</label><br>
            <input type="email" name="email" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Mật khẩu:</label><br>
            <input type="password" name="password" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" style="background: blue; color: white; padding: 10px 20px; border: none; cursor: pointer;">
            Lưu người dùng
        </button>
        <a href="{{ route('users.index') }}" style="margin-left: 10px;">Hủy bỏ</a>
    </form>
</div>
@endsection