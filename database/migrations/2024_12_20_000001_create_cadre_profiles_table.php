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
        Schema::create('cadre_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nik')->unique()->nullable()->comment('Nomor Induk Kader');
            $table->string('full_name');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->enum('gender', ['male', 'female']);
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('student_id')->nullable();
            $table->string('institution')->default('Universitas Brawijaya');
            $table->string('faculty')->default('Hukum');
            $table->string('komisariat')->default('Hukum Brawijaya');
            $table->string('study_program')->nullable();
            $table->year('entry_year')->nullable();
            $table->enum('membership_status', ['active', 'inactive', 'alumni'])->default('inactive');
            $table->date('join_date')->nullable();
            $table->string('position')->nullable()->comment('Position in organization');
            $table->string('avatar')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->index(['nik']);
            $table->index(['membership_status']);
            $table->index(['komisariat']);
            $table->index(['is_verified']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cadre_profiles');
    }
};