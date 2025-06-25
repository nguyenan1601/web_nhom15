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

    // Relationships
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query; // Không lọc theo status vì không có cột này
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name'); // Sắp xếp theo name thay vì sort_order
    }

    // Accessors
    public function getPhonesCountAttribute()
    {
        return $this->phones()->where('status', 'active')->count();
    }

    // Lấy danh sách category, sắp xếp theo name
    public static function getAllCategories()
    {
        return self::orderBy('name')->get();
    }
}