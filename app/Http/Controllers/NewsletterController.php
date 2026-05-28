<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsletterSubscriptionRequest;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;

class NewsletterController extends Controller
{
    public function store(StoreNewsletterSubscriptionRequest $request): RedirectResponse
    {
        NewsletterSubscriber::query()->create([
            'email' => $request->validated('email'),
            'source' => $request->input('source', 'footer'),
            'subscribed_at' => now(),
        ]);

        return back()->with('newsletter_success', 'Thank you for subscribing to our updates.');
    }
}
