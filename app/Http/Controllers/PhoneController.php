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
        $brands = \App\Models\Brand::active()->ordered()->get();
        $categories = \App\Models\Category::active()->ordered()->get();
        return view('admin.phones.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'status' => 'required|string',
            'image_path' => 'nullable|string',
        ]);
        $phone = \App\Models\Phone::create($validated);
        return redirect()->route('admin.phones.index')->with('success', 'Đã thêm sản phẩm mới!');
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
    public function edit(\App\Models\Phone $phone)
    {
        $brands = \App\Models\Brand::active()->ordered()->get();
        $categories = \App\Models\Category::active()->ordered()->get();
        return view('admin.phones.edit', compact('phone', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Phone $phone)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'status' => 'required|string',
            'image_path' => 'nullable|string',
        ]);
        $phone->update($validated);
        return redirect()->route('admin.phones.index')->with('success', 'Đã cập nhật sản phẩm!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Phone $phone)
    {
        $phone->delete();
        return redirect()->route('admin.phones.index')->with('success', 'Đã xoá sản phẩm!');
    }

    /**
     * Trang quản trị sản phẩm cho admin
     */
    public function adminIndex()
    {
        $phones = Phone::with(['brand', 'category'])->orderBy('created_at', 'desc')->paginate(12);
        return view('admin.phones.index', compact('phones'));
    }
}
