<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use Illuminate\Support\Facades\Log;

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
    }    /**
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

        $cart = session()->get('cart', []);
        
        // Create unique key for product with color
        $cartKey = $id . '_' . $request->color;

        if (isset($cart[$cartKey])) {
            // Check if adding quantity exceeds stock
            $newQuantity = $cart[$cartKey]['quantity'] + $request->quantity;
            if ($newQuantity > $phone->stock_quantity) {
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho!');
            }
            $cart[$cartKey]['quantity'] = $newQuantity;
        } else {
            $cart[$cartKey] = [
                "id" => $phone->id,
                "name" => $phone->name,
                "quantity" => $request->quantity,
                "price" => $phone->price,
                "color" => $request->color,
                "image" => $phone->image_path ?? null
            ];
        }        session()->put('cart', $cart);

        // Check if this is a "buy now" request
        if ($request->has('buy_now') && $request->buy_now == '1') {
            return redirect()->route('checkout.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng! Tiến hành thanh toán.');
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Get phone to check stock
            $phoneId = $cart[$id]['id'] ?? explode('_', $id)[0];
            $phone = Phone::find($phoneId);
            
            if ($phone && $request->quantity <= $phone->stock_quantity) {
                $cart[$id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
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
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Sản phẩm đã được xoá khỏi giỏ hàng!');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
    }
}