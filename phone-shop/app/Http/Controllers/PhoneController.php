<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        // Sorting
        switch ($request->sort) {
            case 'price_asc':
                $phones->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $phones->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $phones->orderBy('name', 'asc');
                break;
            case 'newest':
                $phones->latest();
                break;
            case 'popular':
                $phones->orderBy('view_count', 'desc');
                break;
            default:
                $phones->featured()->latest();
        }

        $phones = $phones->paginate(12);

        $brands = Brand::active()->ordered()->get();
        $categories = Category::active()->ordered()->get();

        return view('phones.index', compact('phones', 'brands', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
        // Tăng view count
        $phone->increment('view_count');

        // Load relationships
        $phone->load(['brand', 'category', 'images', 'reviews' => function($query) {
            $query->where('status', 'approved')->with('customer')->latest();
        }]);

        // Sản phẩm liên quan (cùng thương hiệu hoặc danh mục)
        $relatedPhones = Phone::with(['brand', 'category'])
            ->available()
            ->where('id', '!=', $phone->id)
            ->where(function($query) use ($phone) {
                $query->where('brand_id', $phone->brand_id)
                      ->orWhere('category_id', $phone->category_id);
            })
            ->limit(4)
            ->get();

        return view('phones.show', compact('phone', 'relatedPhones'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Phone $phone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phone $phone)
    {
        //
    }
}
