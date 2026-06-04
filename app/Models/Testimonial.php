<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'company',
        'message',
        'avatar',
        'rating',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating'    => 'integer',
    ];

    /**
     * Scope for active testimonials sorted by order.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Get star rating as HTML-safe array of booleans.
     */
    public function getStarsAttribute(): array
    {
        $stars = [];
        for ($i = 1; $i <= 5; $i++) {
            $stars[] = $i <= $this->rating;
        }
        return $stars;
    }

    /**
     * Get display designation (with company if available).
     */
    public function getDesignationDisplayAttribute(): string
    {
        $parts = [];
        if ($this->designation) {
            $parts[] = $this->designation;
        }
        if ($this->company) {
            $parts[] = $this->company;
        }
        return implode(', ', $parts);
    }
}
