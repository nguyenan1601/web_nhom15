<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; // bảng categories

    protected $fillable = [
        'name', 'status', 'sort_order', 'created_at', 'updated_at'
    ];

    // Lấy danh sách category đang active, sắp xếp theo sort_order
    public static function getAllCategories()
    {
        return self::where('status', 'active')
            ->orderBy('sort_order')
            ->get();
    }
}