<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Hiển thị danh sách đơn hàng của khách hàng
     */
    public function index()
    {
        $user = Auth::user();
        
        $orders = Order::where('shipping_email', $user->email)
            ->orWhereHas('customer', function($query) use ($user) {
                $query->where('email', $user->email);
            })
            ->with(['orderItems.phone'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Hiển thị chi tiết đơn hàng
     */
    public function show($id)
    {
        $user = Auth::user();
        
        $order = Order::where('id', $id)
            ->where(function($query) use ($user) {
                $query->where('shipping_email', $user->email)
                    ->orWhereHas('customer', function($q) use ($user) {
                        $q->where('email', $user->email);
                    });
            })
            ->with(['orderItems.phone', 'confirmedBy', 'shippedBy'])
            ->firstOrFail();

        return view('customer.orders.show', compact('order'));
    }

    /**
     * Xác nhận đã nhận hàng
     */
    public function confirmReceived(Request $request, $id)
    {
        $user = Auth::user();
        
        $order = Order::where('id', $id)
            ->where(function($query) use ($user) {
                $query->where('shipping_email', $user->email)
                    ->orWhereHas('customer', function($q) use ($user) {
                        $q->where('email', $user->email);
                    });
            })
            ->firstOrFail();

        if (!in_array($order->status, ['delivered', 'shipped'])) {
            return back()->with('error', 'Chỉ có thể xác nhận nhận hàng khi đơn hàng đã được giao hoặc đang giao');
        }

        $order->update([
            'status' => 'completed',
            'completed_at' => now(),
            'notes' => ($order->notes ? $order->notes . "\n" : '') . 'Khách hàng xác nhận đã nhận hàng lúc ' . now()->format('d/m/Y H:i:s')
        ]);

        return back()->with('success', 'Cảm ơn bạn đã xác nhận nhận hàng. Đơn hàng đã hoàn thành!');
    }

    /**
     * Hủy đơn hàng (chỉ khi còn pending hoặc confirmed)
     */
    public function cancel(Request $request, $id)
    {
        $request->validate([
            'cancel_reason' => 'required|string|max:500'
        ]);

        $user = Auth::user();
        
        $order = Order::where('id', $id)
            ->where(function($query) use ($user) {
                $query->where('shipping_email', $user->email)
                    ->orWhereHas('customer', function($q) use ($user) {
                        $q->where('email', $user->email);
                    });
            })
            ->firstOrFail();

        if (!in_array($order->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Chỉ có thể hủy đơn hàng khi còn ở trạng thái chờ xử lý hoặc đã xác nhận');
        }

        $order->update([
            'status' => 'cancelled',
            'notes' => ($order->notes ? $order->notes . "\n" : '') . 'Khách hàng hủy đơn: ' . $request->cancel_reason
        ]);

        return back()->with('success', 'Đã hủy đơn hàng thành công');
    }
}
