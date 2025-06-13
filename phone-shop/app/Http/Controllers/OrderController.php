<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng.
     */
    public function index()
    {
        $orders = Order::with('items')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Hiển thị chi tiết một đơn hàng.
     */
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Xoá một đơn hàng.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->items()->delete(); // Xoá các sản phẩm trong đơn hàng
        $order->delete(); // Xoá đơn hàng

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xoá.');
    }
}
