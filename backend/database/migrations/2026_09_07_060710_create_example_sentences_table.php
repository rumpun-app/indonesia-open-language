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
        Schema::create('example_sentences', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignUlid('language_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('dialect_id')->nullable()->constrained()->nullOnDelete(); $table->foreignUlid('lexical_entry_id')->nullable()->constrained()->nullOnDelete(); $table->foreignUlid('phrase_id')->nullable()->constrained()->nullOnDelete();
            $table->text('text'); $table->text('translation')->nullable(); $table->text('context')->nullable(); $table->string('status')->default('draft')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('example_sentences');
    }
};
