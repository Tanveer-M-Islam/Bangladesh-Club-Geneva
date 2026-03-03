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
            $table->string('gs_name')->nullable();
            $table->string('gs_image_path')->nullable();
            $table->mediumText('gs_speech')->nullable();
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
