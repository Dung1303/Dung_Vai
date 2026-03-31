@extends('layouts.auth_master')

@section('content')
{{-- Gọi CSS để làm đẹp --}}
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="auth-wrapper">
    <div class="auth-box">
        <form action="{{ route('register') }}" method="POST" class="beta-form-checkout">
            @csrf
            <h4>ĐĂNG KÝ</h4>

            {{-- Hiển thị lỗi nếu nhập sai định dạng --}}
            @if ($errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="form-block">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required placeholder="Nhập email của bạn">
            </div>

            <div class="form-block">
                <label for="name">Fullname*</label>
                <input type="text" id="name" name="name" required placeholder="Nhập họ và tên">
            </div>

            <div class="form-block">
                <label for="password">Password*</label>
                <input type="password" id="password" name="password" required placeholder="Mật khẩu ít nhất 6 ký tự">
            </div>

            <div class="form-block">
                <label for="c_password">Re-password*</label>
                <input type="password" id="c_password" name="password_confirmation" required placeholder="Nhập lại mật khẩu">
            </div>

            <div class="form-block">
                <button type="submit" class="btn-primary">Đăng ký ngay</button>
            </div>

            <div class="auth-footer">
                <p>Đã có tài khoản? <a href="/login">Đăng nhập tại đây</a></p>
                <a href="{{ route('trangchu') }}" class="back-home">← Quay lại trang chủ</a>
            </div>
        </form>
    </div>
</div>
@endsection