<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;


class PhoneController extends Controller
{public function index(Request $request)
{
    $phones = Phone::with(['brand', 'category'])
        ->available();

    // Filters
    if ($request->brand) {
        $phones->byBrand($request->brand);
    }

    if ($request->category) {
        $phones->byCategory($request->category);
    }

    if ($request->min_price && $request->max_price) {
        $phones->priceRange($request->min_price, $request->max_price);
    }

    // Sorting - Sửa lỗi ở phần này
    $sort = $request->get('sort', 'featured');
    switch ($sort) {
        case 'newest':
            $phones->orderBy('released_at', 'desc');
            break;
        case 'price_asc':
            $phones->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $phones->orderBy('price', 'desc');
            break;
        case 'popular':
            $phones->orderBy('view_count', 'desc');
            break;
        case 'featured':
        default:
            $phones->featured()->orderBy('sort_order', 'asc');
            break;
    }

    $phones = $phones->paginate(12);

    $brands = Brand::active()->ordered()->get();
    $categories = Category::active()->ordered()->get();

    return view('phones.index', compact('phones', 'brands', 'categories'));
}
}
