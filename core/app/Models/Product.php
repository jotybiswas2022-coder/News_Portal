<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'tagline',
        'description',
        'image',
        'download_link',
        'indicator',
        'pairs',
        'reviews',
        'live_signal_years',
        'hero_tagline',
        'hero_description',
        'features',
        'plans',
        'feature_image_1',
        'feature_image_2',
        'feature_image_3',
        'available',
    ];

    protected function casts(): array
    {
        return [
            'pairs' => 'array',
            'features' => 'array',
            'plans' => 'array',
            'available' => 'boolean',
            'reviews' => 'integer',
            'live_signal_years' => 'decimal:1',
            'reviews' => 'integer',
        ];
    }
}
