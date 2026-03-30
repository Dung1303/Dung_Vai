@extends('layouts.auth_master')
@section('title', 'Quản lý người dùng')

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">DANH SÁCH NGƯỜI DÙNG</h2>
            
            {{-- Nút Thêm mới --}}
            <a href="{{ route('users.create') }}" class="btn btn-success" style="margin-bottom: 15px; display: inline-block; padding: 10px; background: green; color: white; text-decoration: none; border-radius: 5px;">
                + Thêm User mới
            </a>

            {{-- Thông báo thành công nếu có --}}
            @if(session('success'))
                <div style="color: green; font-weight: bold; margin-bottom: 10px;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Bảng danh sách --}}
            <table border="1" width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
                <thead style="background: #f2f2f2;">
                    <tr>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Ngày tạo</th>
                        <th width="150">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                {{-- Nút Xóa dùng Form POST + Method DELETE --}}
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa user này không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: red; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Chưa có người dùng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <br>
            <a href="{{ route('trangchu') }}"> Quay lại trang chủ</a>
        </div>
    </div>
</div>
@endsection