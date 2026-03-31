@extends('layouts.auth_master')

@section('content')
<div class="container" style="padding: 20px; max-width: 600px; margin: auto;">
    <h2>THÊM NGƯỜI DÙNG MỚI</h2>
    <hr>

    {{-- Hiển thị tất cả lỗi nếu validate thất bại --}}
    @if ($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf {{-- Thẻ bảo mật bắt buộc --}}
        
        <div style="margin-bottom: 15px;">
            <label>Họ tên:</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Mật khẩu:</label><br>
            <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" style="background: #2563eb; color: white; padding: 10px 25px; border: none; cursor: pointer; border-radius: 5px; font-weight: bold;">
                LƯU NGƯỜI DÙNG
            </button>
            <a href="{{ route('users.index') }}" style="margin-left: 15px; color: #666; text-decoration: none;">Hủy bỏ</a>
        </div>
    </form>
</div>
@endsection