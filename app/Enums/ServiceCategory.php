<?php

namespace App\Enums;

enum ServiceCategory: string
{
    case Qualification = 'qualification';
    case CommunityService = 'community_service';

    public function label(): string
    {
        return match ($this) {
            self::Qualification => 'Vocational qualification',
            self::CommunityService => 'Community service',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
