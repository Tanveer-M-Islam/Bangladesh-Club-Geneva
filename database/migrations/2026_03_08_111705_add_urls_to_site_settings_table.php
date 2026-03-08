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
            $table->string('ad1_url')->nullable()->after('ad1_path');
            $table->string('ad2_url')->nullable()->after('ad2_path');
            $table->string('ad3_url')->nullable()->after('ad3_path');
            $table->string('ad4_url')->nullable()->after('ad4_path');
            $table->string('ad5_url')->nullable()->after('ad5_path');
            $table->string('ad6_url')->nullable()->after('ad6_path');
            $table->string('ad7_url')->nullable()->after('ad7_path');
            $table->string('ad8_url')->nullable()->after('ad8_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'ad1_url', 'ad2_url', 'ad3_url', 'ad4_url',
                'ad5_url', 'ad6_url', 'ad7_url', 'ad8_url',
            ]);
        });
    }
};
