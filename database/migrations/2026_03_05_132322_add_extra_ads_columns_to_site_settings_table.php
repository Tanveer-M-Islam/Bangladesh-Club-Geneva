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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('ad5_path')->nullable();
            $table->string('ad6_path')->nullable();
            $table->string('ad7_path')->nullable();
            $table->string('ad8_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['ad5_path', 'ad6_path', 'ad7_path', 'ad8_path']);
        });
    }
};
