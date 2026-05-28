<?php

namespace App\Support;

class FocusPillarIcons
{
    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            'sparkles' => 'Sparkles (default)',
            'academic-cap' => 'Education & skills',
            'users' => 'Community',
            'bolt' => 'Energy & renewables',
            'heart' => 'Care & support',
            'globe-alt' => 'Climate action',
            'sun' => 'Sustainability',
            'hand-raised' => 'Advocacy',
        ];
    }

    public static function isValid(string $icon): bool
    {
        return array_key_exists($icon, self::options());
    }
}
