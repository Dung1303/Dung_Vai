@extends('layouts.master')

@section('title', 'Trang chủ - Sản phẩm')

@section('content')

{{-- Link Users --}}
<a href="{{ route('users.index') }}" style="display:block; margin-bottom:10px; font-weight: bold; color: green;">
     Quản lý Users
</a>

{{-- Nút thêm sản phẩm --}}
<a href="{{ route('products.create') }}" style="font-weight: bold;">
    + Thêm sản phẩm
</a>

<br><br>

{{-- Bảng sản phẩm --}}
<table border="1" width="100%" cellpadding="8" cellspacing="0">
    <tr style="background: #f0f0f0;">
        <th>Tên</th>
        <th>Giá</th>
        <th>Loại</th>
        <th>Tồn</th>
        <th>Hành động</th>
    </tr>

    @forelse($products as $p)
    <tr>
        <td>
            <a href="{{ route('products.show', $p->id) }}">
                {{ $p->name }}
            </a>
        </td>
        <td>{{ number_format($p->price) }}</td>
        <td>{{ $p->category->name ?? 'Không có' }}</td>
        <td>{{ $p->stock }}</td>
        <td>
            <a href="{{ route('products.edit', $p->id) }}">Sửa</a> |

            <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Xóa sản phẩm này?')"
                    style="border:none; background:none; color:blue; cursor:pointer;">
                    Xóa
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" style="text-align:center;">Không có sản phẩm</td>
    </tr>
    @endforelse

</table>

@endsection