<?php

namespace Database\Seeders;

use App\Enums\ServiceCategory;
use App\Models\FocusPillar;
use App\Models\MissionSection;
use App\Models\ServicePillar;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => config('brand.name'),
                'hero_headline' => config('brand.hero.headline'),
                'hero_subheadline' => 'A UK Community Interest Company advancing climate action, green skills, and community resilience.',
                'hero_cta_text' => 'Get Involved',
                'hero_cta_url' => null,
                'video_slider_heading' => 'Video slider',
                'video_slider_description' => 'Showcase clips with a video slider that plays videos from multiple sources in a smooth slideshow, improving design and keeping visitors engaged.',
                'video_slider_cta_text' => 'Create Widget for Free',
                'video_slider_cta_url' => route('contact'),
                'meta_description_default' => 'Restore Global Initiative empowers UK communities through green skills, clean energy, and climate action as a registered Community Interest Company.',
                'contact_email' => config('brand.contact.email'),
                'instagram_url' => config('brand.social.instagram'),
                'x_url' => config('brand.social.x'),
                'footer_statement' => config('brand.legal.footer_statement'),
                'impact_stat_1_number' => '500+',
                'impact_stat_1_label' => 'Households supported through green skills outreach',
                'impact_stat_2_number' => '120+',
                'impact_stat_2_label' => 'Women engaged in climate & energy programmes',
                'impact_stat_3_number' => '80+',
                'impact_stat_3_label' => 'Young adults on pathways to clean energy careers',
            ],
        );

        $focusPillars = [
            [
                'title' => 'STEM & Green Skills Equity',
                'description' => 'Opening pathways into sustainability careers for underrepresented groups through practical training, mentoring, and employer connections.',
                'icon' => 'academic-cap',
                'sort_order' => 1,
            ],
            [
                'title' => 'Women in Climate Leadership',
                'description' => 'Supporting women — especially single mothers and low-income households — with energy awareness, entrepreneurship, and leadership in green innovation.',
                'icon' => 'heart',
                'sort_order' => 2,
            ],
            [
                'title' => 'Renewable Pathways for Youth',
                'description' => 'Equipping young adults with apprenticeships, green skills, and confidence to thrive in the net zero economy and lead local climate action.',
                'icon' => 'bolt',
                'sort_order' => 3,
            ],
        ];

        foreach ($focusPillars as $pillar) {
            FocusPillar::query()->updateOrCreate(
                ['title' => $pillar['title']],
                array_merge($pillar, ['is_active' => true]),
            );
        }

        $missions = [
            [
                'title' => 'Vulnerable Households',
                'content' => 'We will help vulnerable households reduce energy costs through efficiency upgrades, renewable energy access, and tailored climate education. By improving home insulation and promoting sustainable living, it will alleviate fuel poverty, enhance health outcomes, and build resilience against climate impacts, ensuring no household is left behind.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Women',
                'content' => 'We will support women through training, leadership, and employment in sustainability sectors. It will promote energy awareness, entrepreneurship, and financial independence, especially for single mothers and low-income women. By engaging women as climate champions, it strengthens families and communities while advancing gender equality in green innovation.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Young Adults',
                'content' => 'Our Work will equip young adults with green skills, apprenticeships, and pathways into clean energy careers. By fostering innovation, environmental awareness, and entrepreneurship, it will prepare them for the net zero economy. The initiative empowers youth to lead climate action and drive sustainable change in their communities.',
                'sort_order' => 3,
            ],
        ];

        foreach ($missions as $mission) {
            MissionSection::query()->updateOrCreate(
                ['title' => $mission['title']],
                array_merge($mission, ['is_active' => true]),
            );
        }

        $pillars = [
            [
                'title' => 'Green Awareness & Sensitisation Campaigns',
                'category' => ServiceCategory::CommunityService,
                'summary' => "• Workshops and school outreach on climate action\n• Culturally inclusive messaging for BAME communities\n• Practical tips on energy efficiency and waste reduction",
                'content' => 'Host workshops, community forums, and school outreach events to raise awareness about climate change, waste reduction, and energy efficiency. Use relatable, culturally inclusive messages to engage BAME groups and vulnerable households on sustainable living and reducing carbon footprints.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Community Clean Energy & Action Projects',
                'category' => ServiceCategory::Qualification,
                'summary' => "• Volunteer-led home energy audits\n• Community gardens and local renewables education\n• Hands-on training for net zero action at grassroots level",
                'content' => 'Launch local renewable energy education, community gardens, and recycling awareness campaigns that empower residents to take direct climate action. Include volunteer-led energy audits and training on homes, promoting ownership of net zero goals at the grassroots level.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Digital Advocacy & E-Learning for Sustainability',
                'category' => ServiceCategory::Qualification,
                'summary' => "• Short courses and webinars on sustainability\n• Toolkits for women and youth advocates\n• Pathways into green entrepreneurship",
                'content' => 'Develop an online learning platform offering short courses, webinars, and advocacy toolkits on sustainability, climate policy, and green entrepreneurship. Equip women and youth with digital resources to become sustainability advocates and lead local environmental initiatives.',
                'sort_order' => 3,
            ],
        ];

        foreach ($pillars as $pillar) {
            ServicePillar::query()->updateOrCreate(
                ['title' => $pillar['title']],
                array_merge($pillar, [
                    'is_active' => true,
                    'show_on_home' => true,
                ]),
            );
        }
    }
}
