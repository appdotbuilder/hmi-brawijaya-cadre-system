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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cadre_id')->constrained('users');
            $table->datetime('check_in_time');
            $table->datetime('check_out_time')->nullable();
            $table->enum('status', ['present', 'late', 'absent', 'excused'])->default('present');
            $table->text('notes')->nullable()->comment('Additional notes from cadre');
            $table->string('check_in_method')->default('manual')->comment('manual, qr_code, etc.');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();

            $table->unique(['attendance_event_id', 'cadre_id']);
            $table->index(['cadre_id']);
            $table->index(['status']);
            $table->index(['check_in_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};