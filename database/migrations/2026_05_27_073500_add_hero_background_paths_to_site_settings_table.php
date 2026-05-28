<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->json('hero_background_paths')->nullable()->after('hero_background_path');
        });

        DB::table('site_settings')
            ->whereNotNull('hero_background_path')
            ->where('hero_background_path', '!=', '')
            ->orderBy('id')
            ->get(['id', 'hero_background_path'])
            ->each(function (object $row): void {
                DB::table('site_settings')
                    ->where('id', $row->id)
                    ->update([
                        'hero_background_paths' => json_encode([$row->hero_background_path], JSON_THROW_ON_ERROR),
                    ]);
            });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('hero_background_paths');
        });
    }
};
