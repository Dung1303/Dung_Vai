<header style="padding: 10px; border-bottom: 1px solid #ccc;">

    <h1>Sản phẩm</h1>

    {{-- Khu vực user --}}
    <div style="float: right;">

        @auth
        {{-- Đã đăng nhập --}}
        Xin chào, <strong>{{ Auth::user()->name }}</strong> |

        <a href="{{ route('logout') }}" style="text-decoration: none; color: blue; font-weight: bold;"
            onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')">
            Logout
        </a>

        @else
        {{-- Chưa đăng nhập --}}
        <a href="/login">Đăng nhập</a> |
        <a href="/register">Đăng ký</a>
        @endauth

    </div>

    <div style="clear: both;"></div>

    <hr>

    {{-- Thanh tìm kiếm --}}

    <form method="GET" action="{{ route('trangchu') }}">
        <input type="text" name="keyword" placeholder="Tìm tên..." value="{{ request('keyword') }}">

        <select name="category">
            <option value="">-- Tất cả loại --</option>
            @foreach($categories as $cate)
            <option value="{{ $cate->id }}" {{ request('category') == $cate->id ? 'selected' : '' }}>
                {{ $cate->name }}
            </option>
            @endforeach
        </select>

        <select name="sort">
            <option value="">-- Sắp xếp --</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                Giá tăng dần
            </option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                Giá giảm dần
            </option>
        </select>

        <input type="number" name="price" placeholder="Giá tối đa" value="{{ request('price') }}">

        <button type="submit">Áp dụng</button>
    </form>
    <br>
</header>