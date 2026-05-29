<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceCode extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'description',
        'price',
        'old_price',
        'image',
        'download_link',
        'language',
        'category',
        'platform',
        'version',
        'features',
        'code',
        'available',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'available' => 'boolean',
            'price' => 'decimal:2',
            'old_price' => 'decimal:2',
        ];
    }
}
