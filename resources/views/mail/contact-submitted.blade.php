<x-mail::message>
# New contact form submission

**From:** {{ $submission->name }} ({{ $submission->email }})

**Subject:** {{ $submission->subject }}

**Involvement:** {{ $submission->involvementLabel() }}

**Message:**

{{ $submission->message }}

<x-mail::button :url="url('/admin/contact-submissions/'.$submission->id)">
View in admin
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
