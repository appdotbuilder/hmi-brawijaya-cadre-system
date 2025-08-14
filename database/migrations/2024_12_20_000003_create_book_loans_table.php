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
        Schema::create('book_loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cadre_id')->constrained('users');
            $table->date('requested_date');
            $table->date('approved_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('returned_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'borrowed', 'returned', 'overdue'])->default('pending');
            $table->text('request_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->integer('loan_duration_days')->nullable()->comment('Loan duration set by admin');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('returned_to')->nullable()->constrained('users');
            $table->decimal('fine_amount', 10, 2)->default(0)->comment('Fine for overdue books');
            $table->boolean('fine_paid')->default(false);
            $table->timestamps();

            $table->index(['status']);
            $table->index(['cadre_id']);
            $table->index(['due_date']);
            $table->index(['requested_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_loans');
    }
};