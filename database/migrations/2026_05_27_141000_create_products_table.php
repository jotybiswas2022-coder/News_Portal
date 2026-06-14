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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('indicator')->nullable();
            $table->json('pairs')->nullable();
            $table->integer('reviews')->default(0);
            $table->decimal('live_signal_years', 4, 1)->default(0);
            $table->string('hero_tagline')->nullable();
            $table->text('hero_description')->nullable();
            $table->json('features')->nullable();
            $table->json('plans')->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
