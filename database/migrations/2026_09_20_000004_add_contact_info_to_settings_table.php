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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('contact_instagram')->nullable()->after('nagad_number');
            $table->string('contact_facebook')->nullable()->after('contact_instagram');
            $table->string('contact_phone')->nullable()->after('contact_facebook');
            $table->string('contact_email')->nullable()->after('contact_phone');
        });

        DB::table('settings')
            ->where('id', 1)
            ->update([
                'contact_instagram' => '@eshas_rokomaris2',
                'contact_facebook'  => 'https://facebook.com/',
                'contact_phone'     => '+880 1XXXXXXXXX',
                'contact_email'     => 'hello@example.com',
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_instagram',
                'contact_facebook',
                'contact_phone',
                'contact_email',
            ]);
        });
    }
};