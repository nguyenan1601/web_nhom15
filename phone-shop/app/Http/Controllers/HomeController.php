<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPhones = Phone::getFeaturedPhones(8);
        $latestPhones = Phone::getLatestPhones(6);
        $brands = Phone::getBrands(); // Collection hoặc array

        $categories = Category::getAllCategories();

        $brandPhones = [];
        $popularBrands = ['iPhone', 'Samsung', 'Xiaomi', 'Oppo'];

        foreach ($popularBrands as $brand) {
            // Dùng contains cho Collection
            if ($brands->contains($brand)) {
                $brandPhones[$brand] = Phone::getPhonesByBrand($brand, 4);
            }
        }

        $data = [
            'page_title' => 'Trang chủ - Cửa hàng điện thoại',
            'featured_phones' => $featuredPhones,
            'latest_phones' => $latestPhones,
            'brand_phones' => $brandPhones,
            'brands' => $brands,
            'categories' => $categories
        ];

        return view('home', $data);
    }
}