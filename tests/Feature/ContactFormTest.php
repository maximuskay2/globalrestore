<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SiteContentSeeder::class);
    }

    public function test_contact_form_stores_submission(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'subject' => 'Volunteering',
            'message' => 'I would like to volunteer with your programmes.',
            'involvement_type' => 'volunteer',
        ]);

        $response->assertRedirect(route('contact'));
        $this->assertDatabaseHas('contact_submissions', [
            'email' => 'jane@example.com',
            'involvement_type' => 'volunteer',
        ]);
    }

    public function test_honeypot_returns_success_without_storing(): void
    {
        $this->post(route('contact.store'), [
            'company' => 'Bot Ltd',
            'name' => 'Bot',
            'email' => 'bot@example.com',
            'subject' => 'Spam',
            'message' => 'Spam message',
            'involvement_type' => 'volunteer',
        ])->assertRedirect(route('contact'));

        $this->assertSame(0, ContactSubmission::query()->count());
    }
}
