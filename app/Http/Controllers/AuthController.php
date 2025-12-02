<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    // Hiển thị form đăng ký
    public function showRegisterForm() {
        return view('Login.form_dang_ky');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:20|unique:acc_manager,username',
            'password' => 'required|min:3|confirmed',
        ]);

        AccManager::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user', // mặc định
        ]);

        return redirect('/login/')->with('success', 'Đăng ký thành công!');
    }


    // Hiển thị form login
    public function showLoginForm() {
        return view('Login.form_dang_nhap');
    }

    // Xử lý login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string', // username chứ không phải email
            'password' => 'required'
        ]);

        if (Auth::guard('AccManager')->attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            $account = Auth::guard('AccManager')->user();

            switch ($account->role) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'staff':
                    return redirect('/staff');
                case 'user':
                    return redirect('trang_chu');
                default:
                    Auth::guard('AccManager')->logout();
                    return back()->withErrors([
                        'username' => 'Quyền không hợp lệ!'
                    ]);
            }

            return redirect('trang_chu');
        }

        return back()->withErrors([
            'username' => 'Tên đăng nhập hoặc mật khẩu không đúng!'
        ]);
    }

    // Dashboard
    public function trang_chu_ui() {
        return view('Login.form_trang_chu');
    }


    // Logout
    public function logout(Request $request) {
        Auth::guard('AccManager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("AccManager.login");
    }

}
