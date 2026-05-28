<?php

namespace App\Support;

class VideoEmbed
{
    /**
     * @return array{type: 'youtube'|'vimeo'|'direct'|null, embed: ?string, id: ?string}
     */
    public static function parse(?string $url): array
    {
        if (! filled($url)) {
            return ['type' => null, 'embed' => null, 'id' => null];
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            $id = $matches[1];

            return [
                'type' => 'youtube',
                'id' => $id,
                'embed' => 'https://www.youtube-nocookie.com/embed/'.$id,
            ];
        }

        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches)) {
            $id = $matches[1];

            return [
                'type' => 'vimeo',
                'id' => $id,
                'embed' => 'https://player.vimeo.com/video/'.$id,
            ];
        }

        if (preg_match('/\.(mp4|webm|mov)(\?.*)?$/i', $url)) {
            return ['type' => 'direct', 'embed' => null, 'id' => null];
        }

        return ['type' => null, 'embed' => null, 'id' => null];
    }

    public static function isDirectFile(?string $pathOrUrl): bool
    {
        if (! filled($pathOrUrl)) {
            return false;
        }

        return (bool) preg_match('/\.(mp4|webm|mov)(\?.*)?$/i', $pathOrUrl);
    }
}
