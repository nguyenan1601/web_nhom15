<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Hiển thị danh sách đơn hàng
     */
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'orderItems.phone', 'confirmedBy', 'shippedBy'])
            ->orderBy('created_at', 'desc');

        // Lọc theo trạng thái
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Tìm kiếm theo mã đơn hàng
        if ($request->has('search') && $request->search !== '') {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        $orders = $query->paginate(20);

        $statusCounts = [
            'all' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'confirmed' => Order::where('status', 'confirmed')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    /**
     * Hiển thị chi tiết đơn hàng
     */
    public function show($id)
    {
        $order = Order::with(['customer', 'orderItems.phone', 'confirmedBy', 'shippedBy'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Xác nhận đơn hàng
     */
    public function confirm(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Chỉ có thể xác nhận đơn hàng ở trạng thái chờ xử lý');
        }

        $order->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'confirmed_by' => Auth::id(),
            'admin_notes' => $request->admin_notes
        ]);

        return back()->with('success', 'Đã xác nhận đơn hàng thành công');
    }

    /**
     * Chuyển đơn hàng sang xử lý
     */
    public function process($id)
    {
        $order = Order::findOrFail($id);

        if (!in_array($order->status, ['confirmed', 'pending'])) {
            return back()->with('error', 'Không thể chuyển đơn hàng này sang xử lý');
        }

        $order->update([
            'status' => 'processing'
        ]);

        return back()->with('success', 'Đã chuyển đơn hàng sang xử lý');
    }

    /**
     * Giao hàng
     */
    public function ship(Request $request, $id)
    {
        $request->validate([
            'tracking_number' => 'nullable|string|max:255',
            'shipping_company' => 'nullable|string|max:255',
            'admin_notes' => 'nullable|string'
        ]);

        $order = Order::findOrFail($id);

        if ($order->status !== 'processing') {
            return back()->with('error', 'Chỉ có thể giao những đơn hàng đang xử lý');
        }

        $trackingInfo = [];
        if ($request->tracking_number) {
            $trackingInfo['tracking_number'] = $request->tracking_number;
        }
        if ($request->shipping_company) {
            $trackingInfo['shipping_company'] = $request->shipping_company;
        }

        $order->update([
            'status' => 'shipped',
            'shipped_at' => now(),
            'shipped_by' => Auth::id(),
            'tracking_info' => !empty($trackingInfo) ? $trackingInfo : null,
            'admin_notes' => $request->admin_notes
        ]);

        return back()->with('success', 'Đã giao hàng thành công');
    }

    /**
     * Xác nhận đã giao hàng
     */
    public function markDelivered($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Chỉ có thể xác nhận giao hàng cho những đơn đã được gửi');
        }

        $order->update([
            'status' => 'delivered',
            'delivered_at' => now()
        ]);

        return back()->with('success', 'Đã xác nhận giao hàng thành công');
    }

    /**
     * Hủy đơn hàng
     */
    public function cancel(Request $request, $id)
    {
        $request->validate([
            'cancel_reason' => 'required|string|max:500'
        ]);

        $order = Order::findOrFail($id);

        if (in_array($order->status, ['delivered', 'completed', 'cancelled'])) {
            return back()->with('error', 'Không thể hủy đơn hàng này');
        }

        $order->update([
            'status' => 'cancelled',
            'admin_notes' => 'Lý do hủy: ' . $request->cancel_reason
        ]);

        return back()->with('success', 'Đã hủy đơn hàng thành công');
    }
}
