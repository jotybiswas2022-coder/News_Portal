<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Portrait image for the homepage "Our Promise" band, managed alongside
     * the two rotating hero slides. Nullable, so existing slider rows keep
     * falling back to the newest product photo.
     */
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('about_image')->nullable()->after('slider2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('about_image');
        });
    }
};
