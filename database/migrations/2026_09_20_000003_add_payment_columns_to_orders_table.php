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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('sender_number')->nullable()->after('payment_method');
            $table->string('transaction_id')->nullable()->after('sender_number');
            $table->string('payment_screenshot')->nullable()->after('transaction_id');
            $table->string('advance_method')->nullable()->after('payment_screenshot');
            $table->string('payment_status')->default('unpaid')->after('advance_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'sender_number',
                'transaction_id',
                'payment_screenshot',
                'advance_method',
                'payment_status',
            ]);
        });
    }
};