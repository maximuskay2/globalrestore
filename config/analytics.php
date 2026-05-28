<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Analytics provider
    |--------------------------------------------------------------------------
    |
    | Supported: "none", "ga4", "plausible"
    |
    */

    'provider' => env('ANALYTICS_PROVIDER', 'none'),

    'ga_measurement_id' => env('GA_MEASUREMENT_ID'),

    'plausible_domain' => env('PLAUSIBLE_DOMAIN'),

];
