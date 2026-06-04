<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'category',
        'tags',
        'is_published',
        'published_at',
        'user_id',
    ];

    protected $casts = [
        'is_published'  => 'boolean',
        'published_at'  => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            if ($post->is_published && empty($post->published_at)) {
                $post->published_at = now();
            }
        });

        static::updating(function ($post) {
            if ($post->is_published && empty($post->published_at)) {
                $post->published_at = now();
            }
        });
    }

    /**
     * Get the author of the post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get tags as an array.
     */
    public function getTagsArray(): array
    {
        if (empty($this->tags)) {
            return [];
        }
        return array_map('trim', explode(',', $this->tags));
    }

    /**
     * Get short excerpt (auto-generated if not set).
     */
    public function getExcerpt(int $length = 150): string
    {
        if ($this->excerpt) {
            return $this->excerpt;
        }
        return Str::limit(strip_tags($this->content), $length);
    }

    /**
     * Scope for published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->whereNotNull('published_at');
    }

    /**
     * Scope for recent posts.
     */
    public function scopeRecent($query)
    {
        return $query->published()->orderBy('published_at', 'desc');
    }

    /**
     * Get formatted published date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : 'Not published';
    }

    /**
     * Get reading time in minutes.
     */
    public function getReadingTimeAttribute(): string
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = max(1, ceil($words / 200));
        return $minutes . ' min read';
    }
}
