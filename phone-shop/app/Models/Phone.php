<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';  // bảng tương ứng

    protected $fillable = [
        'name', 'brand', 'status', 'featured', 'created_at', 'updated_at'
    ];

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