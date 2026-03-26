<header style="padding: 10px; border-bottom: 1px solid #ccc;">

    <h1>Sản phẩm</h1>

    {{-- Khu vực user --}}
    <div style="float: right;">

        @auth
        {{-- Đã đăng nhập --}}
        Xin chào, <strong>{{ Auth::user()->name }}</strong> |

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="border:none; background:none; color:blue; cursor:pointer;">
                Logout
            </button>
        </form>

        @else
        {{-- Chưa đăng nhập --}}
        <a href="#">Đăng nhập</a> |
        <a href="#">Đăng ký</a>
        @endauth

    </div>

    <div style="clear: both;"></div>

    <hr>

    {{-- Thanh tìm kiếm --}}
    <form method="GET" action="">
        <input type="text" name="keyword" placeholder="Tìm tên...">

        <select name="category">
            <option value="">-- Tất cả loại --</option>
        </select>

        <select name="sort">
            <option value="">-- Sắp xếp --</option>
        </select>

        <input type="number" name="price" placeholder="Giá tối đa">

        <button type="submit">Áp dụng</button>
    </form>

    <br>
</header>