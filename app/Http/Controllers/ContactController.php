<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactSubmissionRequest;
use App\Mail\ContactFormSubmitted;
use App\Models\ContactSubmission;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact', [
            'settings' => SiteSetting::current(),
            'involvementOptions' => ContactSubmission::involvementOptions(),
        ]);
    }

    public function store(StoreContactSubmissionRequest $request): RedirectResponse
    {
        if ($request->isHoneypotTriggered()) {
            return $this->successRedirect();
        }

        $validated = $request->validated();

        $submission = ContactSubmission::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'involvement_type' => $validated['involvement_type'],
        ]);

        $settings = SiteSetting::current();

        Mail::to($settings->contact_email)->queue(new ContactFormSubmitted($submission));

        return $this->successRedirect();
    }

    protected function successRedirect(): RedirectResponse
    {
        return redirect()
            ->route('contact')
            ->with('success', 'Thank you for reaching out. We will be in touch soon.');
    }
}
