<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Brand;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy sản phẩm nổi bật
        $featuredPhones = Phone::with(['brand', 'category'])
            ->featured()
            ->available()
            ->limit(8)
            ->get();

        // Lấy sản phẩm mới nhất
        $latestPhones = Phone::with(['brand', 'category'])
            ->available()
            ->latest()
            ->limit(6)
            ->get();

        // Lấy thương hiệu nổi bật
        $featuredBrands = Brand::active()
            ->featured()
            ->ordered()
            ->limit(6)
            ->get();

        // Lấy danh mục
        $categories = Category::active()
            ->ordered()
            ->limit(8)
            ->get();

        // Sản phẩm bán chạy (giả lập bằng view_count)
        $bestSellerPhones = Phone::with(['brand', 'category'])
            ->available()
            ->orderBy('view_count', 'desc')
            ->limit(4)
            ->get();

        // Hot deals - sản phẩm có giảm giá cao
        $hotDeals = Phone::with(['brand', 'category'])
            ->available()
            ->where('discount_percentage', '>', 0)
            ->orderBy('discount_percentage', 'desc')
            ->limit(3)
            ->get();

        return view('home', compact(
            'featuredPhones',
            'latestPhones', 
            'featuredBrands',
            'categories',
            'bestSellerPhones',
            'hotDeals'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $brandId = $request->get('brand');
        $categoryId = $request->get('category');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');

        $phones = Phone::with(['brand', 'category'])
            ->available();

        if ($query) {
            $phones->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('model', 'like', "%{$query}%");
            });
        }

        if ($brandId) {
            $phones->byBrand($brandId);
        }

        if ($categoryId) {
            $phones->byCategory($categoryId);
        }

        if ($minPrice && $maxPrice) {
            $phones->priceRange($minPrice, $maxPrice);
        }

        $phones = $phones->paginate(12);

        $brands = Brand::active()->ordered()->get();
        $categories = Category::active()->ordered()->get();

        return view('phones.search', compact(
            'phones', 
            'brands', 
            'categories',
            'query',
            'brandId',
            'categoryId',
            'minPrice',
            'maxPrice'
        ));
    }
}