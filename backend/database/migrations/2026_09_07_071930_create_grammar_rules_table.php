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
        Schema::create('grammar_rules', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignUlid('language_id')->constrained()->cascadeOnDelete(); $table->foreignUlid('dialect_id')->nullable()->constrained()->nullOnDelete(); $table->string('category'); $table->string('title'); $table->text('description'); $table->json('examples')->nullable(); $table->string('status')->default('draft')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grammar_rules');
    }
};
