<?php

namespace Database\Seeders;

use App\Models\NewsPost;
use Illuminate\Database\Seeder;

class NewsPostSeeder extends Seeder
{
    public function run(): void
    {
        NewsPost::query()->updateOrCreate(
            ['slug' => 'welcome-to-restore-global-initiative'],
            [
                'title' => 'Welcome to Restore Global Initiative',
                'excerpt' => 'Our UK Community Interest Company is launching programmes in green skills, clean energy awareness, and community climate action.',
                'content' => "Restore Global Initiative is a Registered UK Community Interest Company dedicated to empowering communities through green skills, clean energy, and climate action.\n\nWe work with vulnerable households, women, and young adults to build resilience, create pathways into the net zero economy, and drive sustainable change at the grassroots level.\n\nExplore our mission and services, or get in touch to volunteer, partner, or support our work.",
                'published_at' => now(),
                'is_published' => true,
            ],
        );
    }
}
