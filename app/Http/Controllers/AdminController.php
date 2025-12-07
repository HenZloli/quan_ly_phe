<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccManager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Hiển thị dashboard
    public function dashboard()
    {
        $users = AccManager::all(); // Lấy tất cả tài khoản
        return view('admin.test', compact('users'));
    }






    // Set role cho tài khoản
    



    
}
