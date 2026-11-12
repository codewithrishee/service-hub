<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
{
    $categories = Category::where('status', true)
        ->latest()
        ->get();

    $services = Service::with('category')
        ->where('status', true)
        ->latest()
        ->take(6)
        ->get();

    return view('home', compact('categories', 'services'));
}
}