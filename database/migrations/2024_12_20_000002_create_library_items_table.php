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
        Schema::create('library_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->text('description')->nullable();
            $table->string('isbn')->nullable();
            $table->string('publisher')->nullable();
            $table->year('publication_year')->nullable();
            $table->enum('type', ['digital', 'print']);
            $table->string('category')->nullable();
            $table->string('language')->default('Indonesian');
            $table->integer('pages')->nullable();
            $table->string('digital_url')->nullable()->comment('URL for digital books');
            $table->integer('total_copies')->default(1)->comment('Total physical copies available');
            $table->integer('available_copies')->default(1)->comment('Currently available copies');
            $table->string('location')->nullable()->comment('Physical location in library');
            $table->string('cover_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();

            $table->index(['type']);
            $table->index(['category']);
            $table->index(['is_active']);
            $table->index(['author']);
            $table->index(['title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_items');
    }
};