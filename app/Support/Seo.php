<?php

namespace App\Support;

use App\Models\SiteSetting;

class Seo
{
    public static function title(?string $pageTitle, SiteSetting $settings): string
    {
        if ($pageTitle) {
            return $pageTitle;
        }

        return $settings->site_name;
    }

    public static function description(?string $description, SiteSetting $settings): string
    {
        return $description
            ?: $settings->meta_description_default
            ?: $settings->site_name.' — green skills, clean energy, and climate action for UK communities.';
    }

    public static function canonical(): string
    {
        return url()->current();
    }

    public static function image(?string $override = null): string
    {
        return $override ?: asset('images/brand/logo-512.png');
    }
}
