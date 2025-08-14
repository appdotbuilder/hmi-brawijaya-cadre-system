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
        Schema::create('attendance_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('activity_type')->nullable()->comment('Type of activity (training, meeting, etc.)');
            $table->string('field')->nullable()->comment('Field or area of activity');
            $table->string('department')->nullable()->comment('Department organizing the event');
            $table->datetime('event_date');
            $table->datetime('registration_start');
            $table->datetime('registration_end');
            $table->string('location')->nullable();
            $table->integer('max_participants')->nullable();
            $table->boolean('is_mandatory')->default(false);
            $table->enum('target_audience', ['all', 'active_cadres', 'specific_komisariat', 'management'])->default('all');
            $table->string('target_komisariat')->nullable()->comment('Specific komisariat if target is specific_komisariat');
            $table->boolean('is_active')->default(true);
            $table->string('qr_code')->nullable()->comment('QR code for quick attendance');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();

            $table->index(['event_date']);
            $table->index(['is_active']);
            $table->index(['target_audience']);
            $table->index(['activity_type']);
            $table->index(['registration_start', 'registration_end']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_events');
    }
};