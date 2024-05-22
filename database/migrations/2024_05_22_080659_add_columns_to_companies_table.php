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
        Schema::table('companies', function (Blueprint $table) {
            $table->unsignedInteger('active_users')->default(0);
            $table->boolean('is_trial')->default(true);
            $table->date('start_date')->nullable();
            $table->date('expiry_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('active_users');
            $table->dropColumn('is_trial');
            $table->dropColumn('start_date');
            $table->dropColumn('expiry_date');
        });
    }
};
