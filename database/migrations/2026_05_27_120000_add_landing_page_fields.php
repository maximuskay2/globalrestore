<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('hero_cta_text')->nullable()->after('hero_subheadline');
            $table->string('hero_cta_url')->nullable()->after('hero_cta_text');
            $table->string('hero_background_path')->nullable()->after('hero_cta_url');

            $table->string('impact_stat_1_number')->nullable()->after('companies_house_number');
            $table->string('impact_stat_1_label')->nullable()->after('impact_stat_1_number');
            $table->string('impact_stat_2_number')->nullable()->after('impact_stat_1_label');
            $table->string('impact_stat_2_label')->nullable()->after('impact_stat_2_number');
            $table->string('impact_stat_3_number')->nullable()->after('impact_stat_2_label');
            $table->string('impact_stat_3_label')->nullable()->after('impact_stat_3_number');

            $table->string('privacy_policy_url')->nullable()->after('impact_stat_3_label');
            $table->string('terms_url')->nullable()->after('privacy_policy_url');
            $table->string('linkedin_url')->nullable()->after('x_url');
            $table->string('facebook_url')->nullable()->after('linkedin_url');
        });

        Schema::table('service_pillars', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title');
            $table->text('summary')->nullable()->after('content');
            $table->boolean('show_on_home')->default(false)->after('is_active');
        });

        Schema::table('news_posts', function (Blueprint $table) {
            $table->string('featured_image_path')->nullable()->after('excerpt');
        });

        Schema::create('focus_pillars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->default('sparkles');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('focus_pillars');

        Schema::table('news_posts', function (Blueprint $table) {
            $table->dropColumn('featured_image_path');
        });

        Schema::table('service_pillars', function (Blueprint $table) {
            $table->dropColumn(['category', 'summary', 'show_on_home']);
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_cta_text',
                'hero_cta_url',
                'hero_background_path',
                'impact_stat_1_number',
                'impact_stat_1_label',
                'impact_stat_2_number',
                'impact_stat_2_label',
                'impact_stat_3_number',
                'impact_stat_3_label',
                'privacy_policy_url',
                'terms_url',
                'linkedin_url',
                'facebook_url',
            ]);
        });
    }
};
