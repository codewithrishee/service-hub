<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')
            ->where('status', true)
            ->latest()
            ->paginate(9);

        $categories = Category::where('status', true)
            ->latest()
            ->get();

        return view('services.index', compact('services', 'categories'));
    }

    public function show($slug)
    {
        $service = Service::with('category')
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $relatedServices = Service::where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->where('status', true)
            ->latest()
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}