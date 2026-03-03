<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $row) {
            $row->id();
            $row->text('footer_info')->nullable();
            $row->string('copyright_text')->nullable();
            $row->string('facebook_url')->nullable();
            $row->string('twitter_url')->nullable();
            $row->string('instagram_url')->nullable();
            $row->string('youtube_url')->nullable();
            $row->timestamps();
        });

        // Insert default record
        \Illuminate\Support\Facades\DB::table('footer_settings')->insert([
            'footer_info' => 'Bangladesh Club Geneva (BCG) is a community organization dedicated to promoting Bangladeshi culture and supporting the community in Geneva, Switzerland.',
            'copyright_text' => 'Copyright © ' . date('Y') . ' Bangladesh Club Geneva. All Rights Reserved.',
            'facebook_url' => 'https://facebook.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
