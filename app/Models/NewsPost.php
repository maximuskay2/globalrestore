<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'featured_image_path',
        'content',
        'published_at',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeLatestPublished(Builder $query): Builder
    {
        return $query->published()->orderByDesc('published_at');
    }

    public static function findPublishedBySlug(string $slug): ?self
    {
        return static::query()->published()->where('slug', $slug)->first();
    }

    public static function makeSlug(string $title): string
    {
        return Str::slug($title);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(NewsComment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->comments()->approved()->latest();
    }

    public function featuredImageUrl(): ?string
    {
        if (! $this->featured_image_path) {
            return null;
        }

        return Storage::disk('public')->url($this->featured_image_path);
    }
}
