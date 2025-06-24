<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;

class CartController extends Controller
{
    /**
     * Hiển thị trang giỏ hàng.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function add(Request $request, $id)
    {
        Log::info('CartController::add called', [
            'phone_id' => $id,
            'user_id' => Auth::id(),
            'request_data' => $request->all()
        ]);

        $phone = Phone::findOrFail($id);

        $cart = session()->get('cart', []);

<<<<<<< Updated upstream
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $phone->name,
                "quantity" => 1,
                "price" => $phone->price,
                "image" => $phone->image ?? null
            ];
=======
        try {
            // Check existing quantity in cart
            $existingCart = Cart::where('phone_id', $id)
                ->where('color', $request->color);
                
            if ($userId) {
                $existingCart->where('user_id', $userId);
            } else {
                $existingCart->where('session_id', $sessionId)->whereNull('user_id');
            }
            
            $existingCart = $existingCart->first();
            $currentQuantity = $existingCart ? $existingCart->quantity : 0;
            
            if ($currentQuantity + $request->quantity > $phone->stock_quantity) {
                Log::warning('Stock exceeded', [
                    'phone_id' => $id,
                    'current_quantity' => $currentQuantity,
                    'requested_quantity' => $request->quantity,
                    'stock_quantity' => $phone->stock_quantity
                ]);
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho!');
            }

            Cart::addToCart($id, $request->quantity, $request->color, $userId, $sessionId);

            Log::info('Product added to cart successfully', [
                'phone_id' => $id,
                'quantity' => $request->quantity,
                'color' => $request->color,
                'buy_now' => $request->has('buy_now'),
                'buy_now_value' => $request->buy_now,
                'all_request_data' => $request->all()
            ]);

            // Check if this is a "buy now" request
            if ($request->has('buy_now') && $request->buy_now == '1') {
                Log::info('Redirecting to checkout for buy now');
                return redirect()->route('checkout.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng! Tiến hành thanh toán.');
            }

            Log::info('Redirecting back for add to cart');
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Exception $e) {
            Log::error('Error adding to cart: ' . $e->getMessage(), [
                'phone_id' => $id,
                'user_id' => $userId,
                'exception' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng: ' . $e->getMessage());
>>>>>>> Stashed changes
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật!');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }

    /**
     * Xoá sản phẩm khỏi giỏ hàng.
     */
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Sản phẩm đã được xoá khỏi giỏ hàng!');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }
}