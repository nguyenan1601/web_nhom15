<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Tạo middleware auth cho tất cả methods
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Hiển thị danh sách đơn hàng của user hiện tại.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Query base
        $query = Order::with(['orderItems.phone'])
            ->where(function($q) use ($user) {
                $q->where('customer_id', $user->id)
                  ->orWhere('shipping_email', $user->email);
            });
            
        // Lọc theo trạng thái nếu có
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Sắp xếp
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->oldest();
                break;
            case 'total_desc':
                $query->orderBy('total_amount', 'desc');
                break;
            case 'total_asc':
                $query->orderBy('total_amount', 'asc');
                break;
            default: // latest
                $query->latest();
                break;
        }
        
        $orders = $query->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    /**
     * Hiển thị chi tiết một đơn hàng.
     */
    public function show($id)
    {
        $user = Auth::user();
        
        $order = Order::with(['orderItems.phone'])
            ->where(function($query) use ($user) {
                $query->where('customer_id', $user->id)
                      ->orWhere('shipping_email', $user->email);
            })
            ->where('id', $id)
            ->firstOrFail();
            
        return view('orders.show', compact('order'));
    }

    /**
     * Hủy một đơn hàng (chỉ cho phép hủy đơn hàng pending).
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        $order = Order::where(function($query) use ($user) {
                $query->where('customer_id', $user->id)
                      ->orWhere('shipping_email', $user->email);
            })
            ->where('id', $id)
            ->where('status', 'pending') // Chỉ cho phép hủy đơn hàng pending
            ->firstOrFail();

        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy thành công.');
    }

    /**
     * Trang quản trị đơn hàng cho admin
     */
    public function adminIndex()
    {
        $orders = Order::with(['orderItems.phone', 'customer'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        return view('admin.orders.index', compact('orders'));
    }
}
