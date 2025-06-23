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
        'name', 'description', 'created_at', 'updated_at'
    ];

    protected $casts = [
        // Removed status and sort_order casts as columns don't exist
    ];

    // Relationships
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        // Since status column doesn't exist, return all records
        return $query;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    // Accessors
    public function getPhonesCountAttribute()
    {
        return $this->phones()->count();
    }

    // Lấy danh sách category, sắp xếp theo tên
    public static function getAllCategories()
    {
        return self::orderBy('name')->get();
    }
}