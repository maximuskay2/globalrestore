@php
    $provider = config('analytics.provider');
    $gaId = config('analytics.ga_measurement_id');
    $plausibleDomain = config('analytics.plausible_domain');
@endphp

@if ($provider === 'ga4' && filled($gaId))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}', { anonymize_ip: true });
    </script>
@elseif ($provider === 'plausible' && filled($plausibleDomain))
    <script defer data-domain="{{ $plausibleDomain }}" src="https://plausible.io/js/script.js"></script>
@endif
