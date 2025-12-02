<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drink;
use App\Models\Material;

class DrinkController extends Controller
{
    // Hiển thị danh sách + form
    public function index()
    {
        $drinks = Drink::with('materials')->get();
        $materials = Material::all();
        return view('admin.form_drinks', compact('drinks','materials'));
    }

    // Thêm đồ uống
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'materials' => 'required|array'
        ]);

        $drink = Drink::create($request->only('name','price'));

        // Chuẩn hóa mảng materials: [material_id => ['quantity'=>value]]
        $syncData = [];
        foreach($request->materials as $id => $mat){
            $syncData[$id] = ['quantity' => $mat['quantity'] ?? 10];
        }
        $drink->materials()->sync($syncData);

        return back()->with('success','Thêm đồ uống thành công!');
    }

    // Cập nhật đồ uống
    public function update(Request $request, $id)
    {
        $drink = Drink::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'materials' => 'required|array'
        ]);

        $drink->update($request->only('name','price'));

        $syncData = [];
        foreach($request->materials as $id => $mat){
            $syncData[$id] = ['quantity' => $mat['quantity'] ?? 10];
        }
        $drink->materials()->sync($syncData);

        return back()->with('success','Cập nhật đồ uống thành công!');
    }

    // Xóa đồ uống
    public function delete($id)
    {
        $drink = Drink::findOrFail($id);
        $drink->materials()->detach(); // Xóa quan hệ pivot
        $drink->delete();

        return back()->with('success','Xóa đồ uống thành công!');
    }
}
