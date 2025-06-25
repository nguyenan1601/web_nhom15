<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';  // bảng tương ứng

    protected $fillable = [
        'name',
        'brand',
        'featured',
        'status',
        'category_id',
        'brand_id',
        'model',
        'price',
        'original_price',
        'description',
        'specifications',
        'stock_quantity',
        'color',
        'storage',
        'condition',
        'discount_percentage',
        'warranty_period',
        'sku',
        'weight',
        'operating_system',
        'screen_size',
        'camera',
        'battery',
        'processor',
        'ram',
        'is_available',
        'view_count',
        'released_at',
        'image_path',
        'detail_image_path'
    ];

    protected $casts = [
        'price' => 'decimal:0',
        'original_price' => 'decimal:0',
        'discount_percentage' => 'decimal:2',
        'weight' => 'decimal:2',
        'featured' => 'boolean',
        'is_available' => 'boolean',
        'view_count' => 'integer',
        'stock_quantity' => 'integer',
        'specifications' => 'json',
        'released_at' => 'datetime',
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PhoneImage::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    // Accessors & Mutators
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_percentage > 0) {
            return $this->price * (100 - $this->discount_percentage) / 100;
        }
        return $this->price;
    }

    public function getIsOnSaleAttribute()
    {
        return $this->discount_percentage > 0;
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->where('status', 'approved')->avg('rating') ?? 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->where('status', 'approved')->count();
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)
                    ->where('status', 'active')
                    ->where('stock_quantity', '>', 0);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByBrand($query, $brandId)
    {
        return $query->where('brand_id', $brandId);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    // Lấy sản phẩm nổi bật
    public static function getFeaturedPhones($limit = 8)
    {
        return self::where('featured', 1)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    // Lấy sản phẩm mới nhất
    public static function getLatestPhones($limit = 6)
    {
        return self::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    // Lấy sản phẩm theo thương hiệu
    public static function getPhonesByBrand($brand, $limit = 4)
    {
        return self::where('brand', $brand)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    // Lấy danh sách thương hiệu
    public static function getBrands()
    {
        return self::where('status', 'active')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');
    }
}