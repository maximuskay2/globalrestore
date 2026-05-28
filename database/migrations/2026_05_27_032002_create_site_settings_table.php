<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Restore Global Initiative');
            $table->string('hero_headline');
            $table->text('hero_subheadline')->nullable();
            $table->string('contact_email');
            $table->string('instagram_url');
            $table->string('x_url');
            $table->text('footer_statement');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
