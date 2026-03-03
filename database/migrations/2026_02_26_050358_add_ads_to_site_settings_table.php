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
            $table->string('ad1_path')->nullable()->after('intro_image_path');
            $table->string('ad2_path')->nullable()->after('ad1_path');
            $table->string('ad3_path')->nullable()->after('ad2_path');
            $table->string('ad4_path')->nullable()->after('ad3_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['ad1_path', 'ad2_path', 'ad3_path', 'ad4_path']);
        });
    }
};
