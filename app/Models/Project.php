<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'tech_stack',
        'live_link',
        'github_link',
        'category',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    /**
     * Get tech stack as an array.
     */
    public function getTechStackArray(): array
    {
        if (empty($this->tech_stack)) {
            return [];
        }
        return array_map('trim', explode(',', $this->tech_stack));
    }

    /**
     * Scope for active projects sorted by order.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
