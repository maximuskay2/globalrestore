<?php

namespace App\Models;

use App\Support\VideoEmbed;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomeVideoSlide extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_url',
        'video_file_path',
        'thumbnail_path',
        'sort_order',
        'is_active',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    public function resolvedVideoUrl(): ?string
    {
        if (filled($this->video_file_path)) {
            return Storage::disk('public')->url($this->video_file_path);
        }

        return filled($this->video_url) ? $this->video_url : null;
    }

    public function embedUrl(bool $autoplay = false): ?string
    {
        if (filled($this->video_file_path)) {
            return null;
        }

        $parsed = VideoEmbed::parse($this->video_url);

        if (! filled($parsed['embed'])) {
            return null;
        }

        $separator = str_contains($parsed['embed'], '?') ? '&' : '?';

        return $parsed['embed'].($autoplay ? $separator.'autoplay=1' : '');
    }

    public function isDirectVideo(): bool
    {
        if (filled($this->video_file_path)) {
            return true;
        }

        return VideoEmbed::isDirectFile($this->video_url);
    }

    public function isEmbeddable(): bool
    {
        return filled($this->embedUrl());
    }

    /**
     * @return array{id: int, title: string, description: ?string, thumbnail: ?string, directVideo: ?string, embed: ?string}
     */
    public function toPlayerPayload(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $this->thumbnailUrl(),
            'directVideo' => $this->isDirectVideo() ? $this->resolvedVideoUrl() : null,
            'embed' => $this->embedUrl(),
        ];
    }

    public function isPlayable(): bool
    {
        return filled($this->thumbnailUrl())
            || $this->isDirectVideo()
            || $this->isEmbeddable();
    }

    public function thumbnailUrl(): ?string
    {
        if (! filled($this->thumbnail_path)) {
            return null;
        }

        return Storage::disk('public')->url($this->thumbnail_path);
    }
}
