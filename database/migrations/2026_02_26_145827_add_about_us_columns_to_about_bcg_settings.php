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
        Schema::table('about_bcg_settings', function (Blueprint $table) {
            $table->string('mission_title')->nullable()->default('Our Mission');
            $table->string('mission_image_path')->nullable();
            $table->mediumText('mission_text')->nullable();
            
            $table->string('vision_title')->nullable()->default('Our Vision');
            $table->string('vision_image_path')->nullable();
            $table->mediumText('vision_text')->nullable();
            
            $table->string('terms_title')->nullable()->default('Committee Terms and Rules');
            $table->string('terms_image_path')->nullable();
            $table->mediumText('terms_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_bcg_settings', function (Blueprint $table) {
            //
        });
    }
};
