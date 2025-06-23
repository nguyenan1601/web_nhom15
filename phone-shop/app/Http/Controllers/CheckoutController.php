<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Phone;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Hiển thị trang thanh toán
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Tính toán tổng tiền
        $subtotal = 0;
        $cartItems = [];
        
        foreach ($cart as $id => $item) {
            $phone = Phone::find($item['id']);
            if ($phone && $phone->stock_quantity >= $item['quantity']) {
                $itemTotal = $item['price'] * $item['quantity'];
                $subtotal += $itemTotal;
                
                $cartItems[] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'color' => $item['color'] ?? 'Không xác định',
                    'total' => $itemTotal,
                    'phone' => $phone
                ];
            }
        }

        // Tính phí ship và thuế
        $shippingFee = $subtotal >= 500000 ? 0 : 30000; // Miễn phí ship từ 500k
        $taxRate = 0.1; // VAT 10%
        $taxAmount = $subtotal * $taxRate;
        $total = $subtotal + $shippingFee + $taxAmount;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shippingFee', 'taxAmount', 'total'));
    }

    /**
     * Xử lý đặt hàng
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_first_name' => 'required|string|max:255',
            'shipping_last_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_email' => 'required|email|max:255',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:255',
            'payment_method' => 'required|in:cod,bank_transfer,momo,vnpay',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        DB::beginTransaction();
        
        try {
            // Tính toán lại tổng tiền
            $subtotal = 0;
            $orderItems = [];
            
            foreach ($cart as $id => $item) {
                $phone = Phone::find($item['id']);
                if (!$phone || $phone->stock_quantity < $item['quantity']) {
                    throw new \Exception("Sản phẩm {$item['name']} không đủ hàng trong kho!");
                }
                
                $itemTotal = $item['price'] * $item['quantity'];
                $subtotal += $itemTotal;
                
                $orderItems[] = [
                    'phone_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'color' => $item['color'] ?? null,
                    'total' => $itemTotal
                ];
            }

            $shippingFee = $subtotal >= 500000 ? 0 : 30000;
            $taxAmount = $subtotal * 0.1;
            $total = $subtotal + $shippingFee + $taxAmount;

            // Tạo đơn hàng
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'shipping_fee' => $shippingFee,
                'total_amount' => $total,
                'currency' => 'VND',
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'waiting',
                'shipping_first_name' => $request->shipping_first_name,
                'shipping_last_name' => $request->shipping_last_name,
                'shipping_phone' => $request->shipping_phone,
                'shipping_email' => $request->shipping_email,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_country' => 'Vietnam',
                'notes' => $request->notes,
            ]);

            // Tạo chi tiết đơn hàng và cập nhật kho
            foreach ($orderItems as $item) {
                $phone = Phone::find($item['phone_id']);
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'phone_id' => $item['phone_id'],
                    'phone_name' => $phone->name,
                    'phone_sku' => $phone->sku ?? 'N/A',
                    'phone_color' => $item['color'],
                    'phone_storage' => $phone->storage ?? 'N/A',
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total_price' => $item['total'],
                    'discount_amount' => 0,
                    'warranty_info' => $phone->warranty_period ?? 'Bảo hành theo nhà sản xuất',
                    'price' => $item['price'], // Cho tương thích với migration mới
                    'color' => $item['color'], // Cho tương thích với migration mới
                    'total' => $item['total'] // Cho tương thích với migration mới
                ]);

                // Giảm số lượng trong kho
                $phone->decrement('stock_quantity', $item['quantity']);
            }

            DB::commit();

            // Xóa giỏ hàng
            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id)
                           ->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Trang thành công
     */
    public function success($orderId)
    {
        $order = Order::with('orderItems.phone')->findOrFail($orderId);
        
        return view('checkout.success', compact('order'));
    }

    /**
     * Xem chi tiết đơn hàng
     */
    public function show($orderId)
    {
        $order = Order::with('orderItems.phone')->findOrFail($orderId);
        
        return view('checkout.order-detail', compact('order'));
    }
}