<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    // Hiển thị menu
    public function index() {
        $drinks = Drink::with('materials')->get();
        return view('Booking.form_dat_do_uong', compact('drinks'));
    }

    // Khách đặt món
    public function order(Request $request) {
        $request->validate([
            'drink_id' => 'required|exists:drinks,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $drink = Drink::with('materials')->find($request->drink_id);

        // Kiểm tra nguyên liệu đủ
        foreach($drink->materials as $mat) {
            if($mat->quantity < $mat->pivot->quantity * $request->quantity){
                return back()->with('error', $mat->name.' không đủ!');
            }
        }

        // Trừ nguyên liệu
        foreach($drink->materials as $mat){
            $mat->quantity -= $mat->pivot->quantity * $request->quantity;
            $mat->save();
        }

        // Lưu order
        Order::create([
            'drink_id' => $drink->id,
            'user_id' => Auth::id() ?? null,
            'quantity' => $request->quantity,
            'price' => $drink->price * $request->quantity,
            'status' => 'pending'
        ]);

        return back()->with('success','Đặt món thành công!');
    }
}
