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
        Schema::table('products', function (Blueprint $table) {
            $table->string('download_link')->nullable()->after('image');
        });

        Schema::table('source_codes', function (Blueprint $table) {
            $table->string('download_link')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('download_link');
        });

        Schema::table('source_codes', function (Blueprint $table) {
            $table->dropColumn('download_link');
        });
    }
};
