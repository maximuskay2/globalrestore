@php
    use App\Support\Seo;

    $pageTitle = trim($__env->yieldContent('title'));
    $metaDescription = trim($__env->yieldContent('meta_description'));
    $ogImage = trim($__env->yieldContent('og_image'));

    $title = Seo::title($pageTitle !== '' ? $pageTitle : null, $settings);
    $description = Seo::description($metaDescription !== '' ? $metaDescription : null, $settings);
    $image = Seo::image($ogImage !== '' ? $ogImage : null);
    $canonical = Seo::canonical();
@endphp

<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $settings->site_name }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
