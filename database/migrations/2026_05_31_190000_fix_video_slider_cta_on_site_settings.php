<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        SiteSetting::query()->each(function (SiteSetting $setting): void {
            $changed = false;

            if (blank($setting->video_slider_cta_text) || $setting->video_slider_cta_text === 'Create Widget for Free') {
                $setting->video_slider_cta_text = 'Contact Us';
                $changed = true;
            }

            $url = $setting->video_slider_cta_url;

            if (filled($url) && (
                str_contains($url, 'railway.app')
                || str_ends_with(rtrim(parse_url($url, PHP_URL_PATH) ?? '', '/'), '/contact')
            )) {
                $setting->video_slider_cta_url = null;
                $changed = true;
            }

            if ($changed) {
                $setting->save();
            }
        });
    }

    public function down(): void
    {
        //
    }
};
