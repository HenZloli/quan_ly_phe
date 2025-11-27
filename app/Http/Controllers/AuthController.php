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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        AccManager::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user',
        ]);


        return redirect('/login/')->with('success', 'Đăng ký thành công, mời đăng nhập!');
    }

    // Hiển thị form login
    public function showLoginForm() {
        return view('Login.form_dang_nhap');
    }

    // Xử lý login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('AccManager')->attempt($request->only('username', 'password'))) {
                // $request->session()->regenerate();
            return redirect('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng!'
        ]);
    }

    // Dashboard
    public function dashboard() {
        return view('Login.form_bang_dieu_khien');
    }

    // Logout
    public function logout(Request $request) {
        Auth::guard('AccManager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("AccManager.login");
    }
}
