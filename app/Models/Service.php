<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'gallery',
        'price',
        'duration',
        'rating',
        'review_count',
        'included',
        'excluded',
        'how_it_works',
        'service_area',
        'availability',
        'verified',
        'status',
    ];

    protected $casts = [
        'gallery' => 'array',
        'included' => 'array',
        'excluded' => 'array',
        'how_it_works' => 'array',
        'rating' => 'decimal:1',
        'verified' => 'boolean',
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}