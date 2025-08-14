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
            $table->enum('role', ['administrator', 'management', 'cadre'])->default('cadre')->after('email');
            $table->boolean('is_verified')->default(false)->after('role');
            $table->timestamp('verified_at')->nullable()->after('is_verified');
            
            $table->index(['role']);
            $table->index(['is_verified']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_verified', 'verified_at']);
        });
    }
};