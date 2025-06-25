<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Phone;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::active()
            ->ordered()
            ->withCount(['phones' => function($query) {
                $query->where('status', 'active');
            }])
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $phones = Phone::with(['brand', 'category'])
            ->available()
            ->byCategory($category->id)
            ->paginate(12);

        return view('categories.show', compact('category', 'phones'));
    }
}
