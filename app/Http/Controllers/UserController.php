<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;


use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function Login(Request $request)
    {
        $login = [
            'name' => $request->input('name'),
            'password' => $request->input('password')
        ];
        if (Auth::attempt($login)) {
            $user = Auth::user();
            Session::put('user', $user);
            echo '<script>alert("Đăng nhập thành công.");window.location.assign("trangchu");</script>';
        } else {
            echo '<script>alert("Đăng nhập thất bại.");window.location.assign("login");</script>';
        }
    }
    public function Logout(Request $request)
{
    Auth::logout();

    // 2. Xóa cái session 'user' mà bạn tự tạo
    $request->session()->forget('user');
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/trangchu')->with('success', 'Đã đăng xuất thành công!');
}

    public function GetUser()
    {
        return view('users.register');
    }
    public function Register(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        $input['password'] = bcrypt($input['password']);
        User::create($input);

        echo '<script>alert("Đăng ký thành công. Vui lòng đăng nhập.");window.location.assign("login");</script>';
    }
    public function index() {
    $users = \App\Models\User::all();
    return view('users.index', compact('users'));
}
public function destroy($id) // Biến $id phải nằm trong ngoặc này
    {
        // 1. Tìm user theo ID
        $user = User::find($id);

        // 2. Kiểm tra nếu có user thì mới xóa
        if ($user) {
            
            // Bảo mật: Không cho phép tự xóa chính mình khi đang đăng nhập
            if ($user->id == Auth::id()) {
                return redirect()->back()->with('error', 'Bạn không thể tự xóa chính mình!');
            }

            $user->delete(); // Lệnh xóa thực sự
            return redirect()->back()->with('success', 'Đã xóa người dùng thành công!');
        }

        // 3. Nếu không tìm thấy user
        return redirect()->back()->with('error', 'Người dùng không tồn tại.');
    }
    // Hàm này có nhiệm vụ: Khi bạn nhấn "Thêm mới", nó sẽ mở file view create lên
public function create()
{
    return view('users.create'); 
}

// Hàm này có nhiệm vụ: Nhận dữ liệu từ Form và lưu vào Database
public function store(Request $request)
{
    // 1. Kiểm tra dữ liệu nhập vào (Validate)
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    // 2. Tạo User mới
    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Nhớ mã hóa mật khẩu!
    ]);

    // 3. Xong thì quay lại trang danh sách và báo thành công
    return redirect()->route('users.index')->with('success', 'Thêm User mới thành công!');
}
}