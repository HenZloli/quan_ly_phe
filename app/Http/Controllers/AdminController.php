<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccManager;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Hiển thị danh sách users
    public function index() {
        $users = AccManager::all();
        return view('Admin.Users.form_index', compact('users'));
    }

    // Form tạo user mới
    public function create() {
        return view('Admin.Users.form_create');
    }

    // Lưu user mới
    public function store(Request $request) {
        $request->validate([
            'username' => 'required|string|max:255|unique:acc_manager,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        AccManager::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/admin/users')->with('success', 'Tài khoản mới đã được tạo!');
    }
}
