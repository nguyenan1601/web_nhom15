<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Phone;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::active()
            ->ordered()
            ->withCount(['phones' => function($query) {
                $query->where('status', 'active');
            }])
            ->get();

        return view('brands.index', compact('brands'));
    }

    public function show(Brand $brand)
    {
        $phones = Phone::with(['brand', 'category'])
            ->available()
            ->byBrand($brand->id)
            ->paginate(12);

        return view('brands.show', compact('brand', 'phones'));
    }
}
