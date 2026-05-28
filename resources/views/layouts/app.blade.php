<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', $settings->site_name)</title>

    @include('partials.seo', ['settings' => $settings])

    <link rel="icon" href="{{ asset('images/brand/favicon-32.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/brand/apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('partials.analytics')
</head>
<body class="bg-cream text-teal-dark font-body antialiased">
    <a href="#main-content" class="skip-link">Skip to main content</a>

    @include('partials.nav', ['settings' => $settings])

    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>

    @include('partials.newsletter')

    @include('partials.footer', ['settings' => $settings])
</body>
</html>
