<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccManager;
use App\Models\Material;
use App\Models\Drink;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Hiển thị dashboard
    public function dashboard()
    {
        $users = AccManager::all(); // Lấy tất cả tài khoản
        return view('admin.form_admin_bang_dieu_khien', compact('users'));
    }

    // Set role cho tài khoản
    public function setRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,staff,admin'
        ]);

        $user = AccManager::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        // Cập nhật session nếu update chính tài khoản đang login
        if (Auth::id() == $user->id) {
            Auth::user()->role = $user->role;
        }

        return back()->with('success', "Đã cập nhật quyền của {$user->username} thành '{$user->role}'!");
    }

    // Nguyên liệu
    public function materialsIndex() {
        $materials = Material::all();
        return view('admin.form_materials', compact('materials'));
    }

    public function materialsStore(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'unit' => 'required|string',
        ]);

        Material::create($request->all());
        return back()->with('success', 'Thêm nguyên liệu thành công!');
    }

    public function materialsUpdate(Request $request, $id) {
        $material = Material::findOrFail($id);
        $material->update($request->all());
        return back()->with('success', 'Cập nhật nguyên liệu thành công!');
    }

    public function materialsDelete($id) {
        Material::findOrFail($id)->delete();
        return back()->with('success', 'Xóa nguyên liệu thành công!');
    }

    



    
}
