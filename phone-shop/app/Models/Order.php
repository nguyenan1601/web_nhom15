<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_id',
        'status',
        'subtotal',
        'tax_amount',
        'shipping_fee',
        'discount_amount',
        'total_amount',
        'currency',
        'payment_method',
        'payment_status',
        'paid_at',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_phone',
        'shipping_email',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_postal_code',
        'shipping_country',
        'notes',
        'coupon_code',
        'shipped_at',
        'delivered_at',
        'tracking_info'
    ];

    protected $casts = [
        'subtotal' => 'decimal:0',
        'tax_amount' => 'decimal:0',
        'shipping_fee' => 'decimal:0',
        'discount_amount' => 'decimal:0',
        'total_amount' => 'decimal:0',
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'tracking_info' => 'json'
    ];

    // Relationships
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Accessors
    public function getShippingFullNameAttribute()
    {
        return $this->shipping_first_name . ' ' . $this->shipping_last_name;
    }

    public function getShippingFullAddressAttribute()
    {
        return $this->shipping_address . ', ' . $this->shipping_city . ', ' . $this->shipping_country;
    }

    public function getItemsCountAttribute()
    {
        return $this->orderItems()->sum('quantity');
    }

    public function getCanCancelAttribute()
    {
        return in_array($this->status, ['pending', 'confirmed']);
    }

    public function getCanRefundAttribute()
    {
        return $this->status === 'delivered' && $this->payment_status === 'paid';
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPaymentStatus($query, $paymentStatus)
    {
        return $query->where('payment_status', $paymentStatus);
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Methods
    public static function generateOrderNumber()
    {
        do {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->orderItems()->sum(\DB::raw('unit_price * quantity'));
        $this->total_amount = $this->subtotal + $this->tax_amount + $this->shipping_fee - $this->discount_amount;
        $this->save();
    }

    public function markAsPaid()
    {
        $this->update([
            'payment_status' => 'paid',
            'paid_at' => now()
        ]);
    }

    public function markAsShipped()
    {
        $this->update([
            'status' => 'shipped',
            'shipped_at' => now()
        ]);
    }

    public function markAsDelivered()
    {
        $this->update([
            'status' => 'delivered',
            'delivered_at' => now()
        ]);
    }
}
