<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('about'), 'priority' => '0.8'],
            ['loc' => route('services'), 'priority' => '0.8'],
            ['loc' => route('contact'), 'priority' => '0.8'],
            ['loc' => route('news.index'), 'priority' => '0.7'],
        ];

        foreach (NewsPost::query()->latestPublished()->get(['slug', 'updated_at']) as $post) {
            $urls[] = [
                'loc' => route('news.show', $post->slug),
                'lastmod' => $post->updated_at->toAtomString(),
                'priority' => '0.6',
            ];
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
