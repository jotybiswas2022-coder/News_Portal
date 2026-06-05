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
            $table->string('feature_image_1')->nullable()->after('features');
            $table->string('feature_image_2')->nullable()->after('feature_image_1');
            $table->string('feature_image_3')->nullable()->after('feature_image_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['feature_image_1', 'feature_image_2', 'feature_image_3']);
        });
    }
};
