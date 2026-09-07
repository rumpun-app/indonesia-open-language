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
        Schema::create('lexical_entries', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('language_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('dialect_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignUlid('region_id')->nullable()->constrained()->nullOnDelete();
            $table->string('part_of_speech')->nullable(); $table->string('register')->nullable();
            $table->text('notes')->nullable(); $table->string('status')->default('draft')->index();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lexical_entries');
    }
};
