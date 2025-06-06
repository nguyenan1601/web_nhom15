<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // bảng categories

    protected $fillable = [
        'name', 'status', 'sort_order', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'sort_order' => 'integer'
    ];

    // Relationships
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Accessors
    public function getPhonesCountAttribute()
    {
        return $this->phones()->where('status', 'active')->count();
    }

    // Lấy danh sách category đang active, sắp xếp theo sort_order
    public static function getAllCategories()
    {
        return self::where('status', 'active')
            ->orderBy('sort_order')
            ->get();
    }
}