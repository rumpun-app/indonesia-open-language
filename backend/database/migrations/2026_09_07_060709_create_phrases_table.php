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
        Schema::create('phrases', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignUlid('language_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('dialect_id')->nullable()->constrained()->nullOnDelete(); $table->text('text'); $table->text('translation')->nullable();
            $table->text('literal_translation')->nullable(); $table->text('context')->nullable(); $table->string('register')->nullable(); $table->string('status')->default('draft')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phrases');
    }
};
