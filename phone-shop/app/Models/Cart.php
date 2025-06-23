<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_id',
        'quantity',
        'color',
        'session_id'
    ];

    /**
     * Quan hệ với User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quan hệ với Phone
     */
    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }

    /**
     * Lấy giỏ hàng theo user hoặc session
     */
    public static function getCart($userId = null, $sessionId = null)
    {
        $query = self::with('phone');
        
        if ($userId) {
            $query->where('user_id', $userId);
        } elseif ($sessionId) {
            $query->where('session_id', $sessionId)->whereNull('user_id');
        }
        
        return $query->get();
    }

    /**
     * Thêm sản phẩm vào giỏ hàng
     */
    public static function addToCart($phoneId, $quantity, $color, $userId = null, $sessionId = null)
    {
        $existingItem = self::where('phone_id', $phoneId)
            ->where('color', $color);
            
        if ($userId) {
            $existingItem->where('user_id', $userId);
        } else {
            $existingItem->where('session_id', $sessionId)->whereNull('user_id');
        }
        
        $existingItem = $existingItem->first();
        
        if ($existingItem) {
            $existingItem->quantity += $quantity;
            $existingItem->save();
            return $existingItem;
        } else {
            return self::create([
                'user_id' => $userId,
                'phone_id' => $phoneId,
                'quantity' => $quantity,
                'color' => $color,
                'session_id' => $sessionId
            ]);
        }
    }

    /**
     * Chuyển giỏ hàng từ session sang user khi đăng nhập
     */
    public static function mergeSessionToUser($sessionId, $userId)
    {
        $sessionCarts = self::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->get();
            
        foreach ($sessionCarts as $sessionCart) {
            $existingUserCart = self::where('user_id', $userId)
                ->where('phone_id', $sessionCart->phone_id)
                ->where('color', $sessionCart->color)
                ->first();
                
            if ($existingUserCart) {
                $existingUserCart->quantity += $sessionCart->quantity;
                $existingUserCart->save();
                $sessionCart->delete();
            } else {
                $sessionCart->update([
                    'user_id' => $userId,
                    'session_id' => null
                ]);
            }
        }
    }

    /**
     * Tính tổng tiền giỏ hàng
     */
    public function getTotalAttribute()
    {
        return $this->quantity * $this->phone->price;
    }
}
