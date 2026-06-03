<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('patient_name');
            $table->string('blood_group', 5);
            $table->string('hospital')->nullable();
            $table->string('location');
            $table->string('contact_phone', 20);
            $table->text('message')->nullable();
            $table->enum('urgency', ['critical', 'urgent', 'normal'])->default('urgent');
            $table->enum('status', ['pending', 'matched', 'fulfilled', 'cancelled'])->default('pending');
            $table->integer('matched_donors_count')->default(0);
            $table->timestamp('fulfilled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};
