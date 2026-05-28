@props(['slug'])

@php
    $asset = \App\Models\MediaAsset::findActiveBySlug($slug);
@endphp

@if ($asset)
    <img
        src="{{ $asset->url() }}"
        alt="{{ $asset->alt_text }}"
        loading="lazy"
        decoding="async"
        {{ $attributes }}
    >
@endif
