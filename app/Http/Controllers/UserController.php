<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ĐĂNG NHẬP
    public function Login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('trangchu')->with('success', 'Đăng nhập thành công.');
        }

        return redirect('login')->with('error', 'Tên hoặc mật khẩu không đúng.');
    }

    // ĐĂNG XUẤT
    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // HIỂN THỊ FORM ĐĂNG KÝ
    public function GetUser()
    {
        return view('users.register');
    }

    // XỬ LÝ ĐĂNG KÝ
    public function Register(Request $request)
{
    // 1. Kiểm tra dữ liệu (Validate)
    $request->validate([
        'name'     => 'required|string|unique:users',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed', 
    ], [
        'name.unique'     => 'Tên đăng nhập đã tồn tại.',
        'email.unique'    => 'Email này đã được sử dụng.',
        'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        'password.min'    => 'Mật khẩu phải có ít nhất 6 ký tự.',
    ]);

    // 2. Tạo User
    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('login')->with('success', 'Đăng ký thành công!');
}
    // DANH SÁCH USER
    public function index() 
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    // HIỂN THỊ FORM THÊM MỚI USER
    public function create()
    {
        return view('users.create');
    }
    // XÓA USER
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            if ($user->id == Auth::id()) {
                return redirect()->back()->with('error', 'Bạn không thể tự xóa chính mình!');
            }
            $user->delete();
            return redirect()->back()->with('success', 'Đã xóa người dùng.');
        }

        return redirect()->back()->with('error', 'Không tìm thấy người dùng.');
    }

    // 3. Xử lý lưu dữ liệu
    public function store(Request $request) {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.unique'  => 'Email này đã tồn tại.',
            'password.min'  => 'Mật khẩu phải từ 6 ký tự.',
        ]);

        // Lưu vào Database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);

        // Quay về trang danh sách kèm thông báo
        return redirect()->route('users.index')->with('success', 'Thêm người dùng thành công!');
    }
}