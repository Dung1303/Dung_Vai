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
        $request->validate([
            'name' => 'required|string|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password'
        ]);

        User::create([
            'name' => $request->name,
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

    // THÊM USER MỚI (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Thêm mới thành công!');
    }
}