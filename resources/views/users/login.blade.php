@extends('layouts.auth_master')

@section('content')
{{-- Gọi file CSS từ thư mục public/css --}}
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="auth-wrapper">
    <form action="{{ route('login') }}" method="post" class="beta-form-checkout">
        @csrf
        <h4>Đăng nhập</h4>
        
        {{-- Hiện lỗi nếu nhập sai --}}
        @if($errors->any())
            <div style="color: red; text-align: center; margin-bottom: 15px; font-weight: bold;">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="form-block">
            <label for="name">User Name*</label>
            <input type="text" id="name" name="name" required placeholder="Nhập tên của bạn">
        </div>

        <div class="form-block">
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
        </div>

        <div class="form-block">
            <button type="submit" class="btn-primary">Login</button>
        </div>

        <div class="text-center">
            <p>Nếu chưa có tài khoản vui lòng <a href="/register">Đăng ký</a>!</p>
            <a href="{{ route('trangchu') }}" style="font-size: 14px; color: #666;"> Quay lại trang chủ</a>
        </div>
    </form>
</div>
@endsection