<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\AccManager;
use App\Models\Drink;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    // Dashboard: show orders đang chờ hoặc đã nhận
    public function dashboard()
    {
        $orders = Order::with('drink','user')
                    ->whereIn('status',['pending','accepted'])
                    ->orderBy('created_at','desc')
                    ->get();

        return view('staff.form_staff_bang_dieu_khien', compact('orders'));
    }

    // Cập nhật trạng thái: accepted hoặc completed
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,completed'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        if($order->status == 'completed'){
            $admin = AccManager::where('role','admin')->first();
            if($admin){
                // đảm bảo giá và số lượng có giá trị
                $orderTotal = ($order->price ?? 0) * ($order->quantity ?? 0);
                $admin->balance = ($admin->balance ?? 0) + $orderTotal;
                $admin->save();
            }
        }

        return back()->with('success','Cập nhật trạng thái đơn thành công!');
    }


    // Hủy đơn
    public function cancelOrder($id)
    {
        $order = Order::with('drink.materials')->findOrFail($id);

        // Nếu order đã sử dụng nguyên liệu → hoàn nguyên
        foreach($order->drink->materials as $mat){
            $mat->quantity += $mat->pivot->quantity * $order->quantity;
            $mat->save();
        }

        $order->status = 'canceled';
        $order->save();

        return back()->with('success','Đơn hàng đã bị hủy!');
    }
}
