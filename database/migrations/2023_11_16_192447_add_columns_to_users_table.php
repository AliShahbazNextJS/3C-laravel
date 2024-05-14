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
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_number')->nullable();
            $table->string('status')->default('active');
            $table->enum('is_approved', ['off', 'on', 'ban'])->default('off');
            $table->enum('is_online', ['0', '1'])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('contact_number');
            $table->dropColumn('status');
            $table->dropColumn('is_approved');
            $table->dropColumn('is_online');
        });
    }
};
