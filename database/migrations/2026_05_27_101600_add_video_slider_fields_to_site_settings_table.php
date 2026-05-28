<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('video_slider_heading')->nullable()->after('hero_background_paths');
            $table->text('video_slider_description')->nullable()->after('video_slider_heading');
            $table->string('video_slider_cta_text')->nullable()->after('video_slider_description');
            $table->string('video_slider_cta_url')->nullable()->after('video_slider_cta_text');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'video_slider_heading',
                'video_slider_description',
                'video_slider_cta_text',
                'video_slider_cta_url',
            ]);
        });
    }
};
