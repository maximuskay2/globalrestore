<?php

namespace Database\Seeders;

use App\Models\HomeVideoSlide;
use Illuminate\Database\Seeder;

class HomeVideoSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Green Energy',
                'video_url' => 'https://youtube.com/shorts/d71jp9EIj4s?feature=share',
                'video_file_path' => null,
                'thumbnail_path' => 'home/videos/01KSMQQE3DDBBGHX234NMQ9PAV.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Skills Acqusition',
                'video_url' => 'https://www.youtube.com/shorts/Ve1U5q0LmtY',
                'video_file_path' => null,
                'thumbnail_path' => 'home/videos/01KSMRXZN5JBSX6PNFPQA5SQGR.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HomeVideoSlide::query()->updateOrCreate(
                ['title' => $slide['title']],
                $slide,
            );
        }
    }
}
