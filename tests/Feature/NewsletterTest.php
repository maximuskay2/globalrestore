<?php

namespace Tests\Feature;

use App\Models\NewsletterSubscriber;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SiteContentSeeder::class);
    }

    public function test_newsletter_subscription_stores_email(): void
    {
        $this->from(route('home'))
            ->post(route('newsletter.store'), ['email' => 'subscriber@example.com'])
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('newsletter_subscribers', [
            'email' => 'subscriber@example.com',
        ]);
    }

    public function test_duplicate_email_is_rejected(): void
    {
        NewsletterSubscriber::query()->create([
            'email' => 'existing@example.com',
            'source' => 'footer',
            'subscribed_at' => now(),
        ]);

        $this->from(route('home'))
            ->post(route('newsletter.store'), ['email' => 'existing@example.com'])
            ->assertSessionHasErrors('email');
    }
}
