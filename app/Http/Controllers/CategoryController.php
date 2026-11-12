<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
// use App\Models\Category;
use App\Models\Service;

class CategoryController extends Controller
{
 public function index()
    {
        $categories = Category::where('status', true)
            ->latest()
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show($slug)
{
    $category = Category::where('slug', $slug)
        ->where('status', true)
        ->firstOrFail();

    $services = Service::with('category')
        ->where('category_id', $category->id)
        ->where('status', true)
        ->latest()
        ->paginate(9);

    return view('categories.show', compact('category', 'services'));
}
}
