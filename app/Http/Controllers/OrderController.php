<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function myOrders()
    {
        $userId = auth()->id();

        $orders = Order::with('drink')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Login.form_user_status', compact('orders'));
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);

        if($order->user_id != auth()->id() || !in_array($order->status, ['pending','accepted'])) {
            return back()->with('error', 'Không thể hủy đơn này.');
        }

        $order->status = 'canceled';
        $order->save();

        return back()->with('success', 'Đơn hàng đã bị hủy.');
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);

        if($order->user_id != auth()->id() || !in_array($order->status, ['completed','canceled'])) {
            return back()->with('error', 'Không thể xóa đơn này.');
        }

        $order->delete();

        return back()->with('success', 'Đơn hàng đã được xóa khỏi lịch sử.');
    }

}
