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
                'featured_image_path' => 'news/featured/01KSMQMHQTT0RYPHVC54NTCVHB.png',
                'published_at' => now(),
                'is_published' => true,
            ],
        );

        $unipodContent = file_get_contents(database_path('seeders/data/unipod-opens-up.txt'));

        NewsPost::query()->updateOrCreate(
            ['slug' => 'unipod-opens-up'],
            [
                'title' => 'Sparking a Green Revolution: UniUyo Inaugurates UNIPOD with a Bold Mandate for Cross-Departmental Renewable Energy',
                'excerpt' => 'The atmosphere at the University of Uyo was electric this week as the institution officially commissioned its University Innovation Pod (UNIPOD). For a university already known for academic excellence, the launch of this state-of-the-art innovation hub marks the beginning of a brand-new chapter—one where technology, youth ingenuity, and sustainability collide.',
                'content' => $unipodContent ?: '',
                'featured_image_path' => 'news/featured/01KSMQKHZCSBDW6MTT9VD4CKTC.jpg',
                'published_at' => now(),
                'is_published' => true,
            ],
        );
    }
}
