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
        Schema::table('source_codes', function (Blueprint $table) {
            $table->string('tagline')->nullable()->after('slug');
            $table->decimal('old_price', 10, 2)->nullable()->after('price');
            $table->string('language')->nullable()->after('image');
            $table->string('category')->nullable()->after('language');
            $table->string('platform')->nullable()->after('category');
            $table->string('version')->nullable()->after('platform');
            $table->longText('code')->nullable()->after('features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('source_codes', function (Blueprint $table) {
            $table->dropColumn(['tagline', 'old_price', 'language', 'category', 'platform', 'version', 'code']);
        });
    }
};
