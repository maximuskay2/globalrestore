<?php

namespace Tests\Feature;

use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SiteContentSeeder::class);
    }

    public function test_home_page_loads(): void
    {
        $this->get(route('home'))->assertOk();
    }

    public function test_about_page_loads(): void
    {
        $this->get(route('about'))->assertOk();
    }

    public function test_services_page_loads(): void
    {
        $this->get(route('services'))->assertOk();
    }

    public function test_contact_page_loads(): void
    {
        $this->get(route('contact'))->assertOk();
    }

    public function test_news_index_loads(): void
    {
        $this->get(route('news.index'))->assertOk();
    }

    public function test_sitemap_is_xml(): void
    {
        $this->get(route('sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml');
    }

    public function test_robots_txt_includes_sitemap(): void
    {
        $this->get(route('robots'))
            ->assertOk()
            ->assertSee('Sitemap:');
    }
}
