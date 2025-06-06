<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'phone_id',
        'phone_name',
        'phone_sku',
        'phone_color',
        'phone_storage',
        'unit_price',
        'quantity',
        'total_price',
        'discount_amount',
        'warranty_info',
        'serial_number',
        'notes'
    ];

    protected $casts = [
        'unit_price' => 'decimal:0',
        'total_price' => 'decimal:0',
        'discount_amount' => 'decimal:0',
        'quantity' => 'integer'
    ];

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function phone(): BelongsTo
    {
        return $this->belongsTo(Phone::class);
    }

    // Accessors
    public function getSubtotalAttribute()
    {
        return $this->unit_price * $this->quantity;
    }

    public function getFinalPriceAttribute()
    {
        return $this->total_price - $this->discount_amount;
    }
}
