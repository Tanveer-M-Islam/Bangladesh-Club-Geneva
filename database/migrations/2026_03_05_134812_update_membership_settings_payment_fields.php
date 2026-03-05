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
        Schema::table('membership_settings', function (Blueprint $table) {
            $table->dropColumn('payment_details');
            $table->string('bank_name')->nullable();
            $table->string('bank_iban')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('qr_code_path')->nullable();
            $table->text('payment_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membership_settings', function (Blueprint $table) {
            $table->text('payment_details')->nullable();
            $table->dropColumn(['bank_name', 'bank_iban', 'bank_account_name', 'qr_code_path', 'payment_note']);
        });
    }
};
