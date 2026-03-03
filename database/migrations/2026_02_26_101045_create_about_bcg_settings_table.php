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
        Schema::create('about_bcg_settings', function (Blueprint $table) {
            $table->id();
            $table->string('president_name')->nullable();
            $table->string('president_image_path')->nullable();
            $table->text('president_speech')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_bcg_settings');
    }
};
