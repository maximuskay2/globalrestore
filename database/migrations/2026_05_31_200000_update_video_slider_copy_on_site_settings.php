<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private const OLD_HEADING = 'Video slider';

    private const OLD_DESCRIPTION = 'Showcase clips with a video slider that plays videos from multiple sources in a smooth slideshow, improving design and keeping visitors engaged.';

    private const NEW_HEADING = 'Our Work in Action';

    private const NEW_DESCRIPTION = 'Watch highlights from Restore Global Initiative programmes — green skills training, clean energy outreach, and community climate action making a difference across the UK.';

    public function up(): void
    {
        SiteSetting::query()->each(function (SiteSetting $setting): void {
            $changed = false;

            if (blank($setting->video_slider_heading) || $setting->video_slider_heading === self::OLD_HEADING) {
                $setting->video_slider_heading = self::NEW_HEADING;
                $changed = true;
            }

            if (blank($setting->video_slider_description) || $setting->video_slider_description === self::OLD_DESCRIPTION) {
                $setting->video_slider_description = self::NEW_DESCRIPTION;
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
