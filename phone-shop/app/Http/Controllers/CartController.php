<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Hiển thị trang giỏ hàng.
     */
    public function index()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();
        
        $cartItems = Cart::getCart($userId, $sessionId);
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->phone->price;
        });

        // Convert to array format for compatibility with existing view
        $cart = [];
        foreach ($cartItems as $item) {
            $key = $item->phone_id . '_' . $item->color;
            $cart[$key] = [
                'id' => $item->phone->id,
                'name' => $item->phone->name,
                'quantity' => $item->quantity,
                'price' => $item->phone->price,
                'color' => $item->color,
                'image' => $item->phone->image_path
            ];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function add(Request $request, $id)
    {
        $phone = Phone::findOrFail($id);
        
        // Validate input
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $phone->stock_quantity,
            'color' => 'required|string'
        ]);

        $userId = Auth::id();
        $sessionId = session()->getId();

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
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho!');
            }            Cart::addToCart($id, $request->quantity, $request->color, $userId, $sessionId);            // Check if this is a "buy now" request
            if ($request->has('buy_now') && $request->buy_now == '1') {
                return redirect()->route('checkout.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng! Tiến hành thanh toán.');
            }

            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Exception $e) {
            Log::error('Error adding to cart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng!');
        }
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $userId = Auth::id();
        $sessionId = session()->getId();
        
        // Parse cart key to get phone_id and color
        $parts = explode('_', $id);
        $phoneId = $parts[0];
        $color = implode('_', array_slice($parts, 1));

        $cartItem = Cart::where('phone_id', $phoneId)
            ->where('color', $color);
            
        if ($userId) {
            $cartItem->where('user_id', $userId);
        } else {
            $cartItem->where('session_id', $sessionId)->whereNull('user_id');
        }
        
        $cartItem = $cartItem->first();

        if ($cartItem) {
            $phone = $cartItem->phone;
            
            if ($phone && $request->quantity <= $phone->stock_quantity) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
                return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật!');
            } else {
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho!');
            }
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }

    /**
     * Xoá sản phẩm khỏi giỏ hàng.
     */
    public function remove(Request $request, $id)
    {
        $userId = Auth::id();
        $sessionId = session()->getId();
        
        // Parse cart key to get phone_id and color
        $parts = explode('_', $id);
        $phoneId = $parts[0];
        $color = implode('_', array_slice($parts, 1));

        $cartItem = Cart::where('phone_id', $phoneId)
            ->where('color', $color);
            
        if ($userId) {
            $cartItem->where('user_id', $userId);
        } else {
            $cartItem->where('session_id', $sessionId)->whereNull('user_id');
        }
        
        $cartItem = $cartItem->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Sản phẩm đã được xoá khỏi giỏ hàng!');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }
}