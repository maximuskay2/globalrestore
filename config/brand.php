<?php

return [
    'name' => 'Restore Global Initiative',
    'colors' => [
        'teal' => '#004242',
        'teal_dark' => '#003333',
        'cream' => '#F2EDE4',
        'cream_muted' => '#E8E2D8',
    ],
    'contact' => [
        'email' => env('BRAND_CONTACT_EMAIL', 'info@restoreglobalinitiative.com'),
    ],
    'social' => [
        'instagram' => env('BRAND_INSTAGRAM_URL', 'https://www.instagram.com/restore_global_initiative/'),
        'x' => env('BRAND_X_URL', 'https://x.com/RestoreGlobal_'),
    ],
    'legal' => [
        'footer_statement' => env(
            'BRAND_FOOTER_STATEMENT',
            'Restore Global Initiative is a Registered UK Community Interest Company.'
        ),
    ],
    'hero' => [
        'headline' => env(
            'BRAND_HERO_HEADLINE',
            'Empowering Communities Through Green Skills, Clean Energy, and Climate Action'
        ),
    ],
];
