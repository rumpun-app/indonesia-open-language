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
        Schema::create('word_forms', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignUlid('lexical_entry_id')->constrained()->cascadeOnDelete();
            $table->string('form'); $table->string('script')->nullable(); $table->string('pronunciation')->nullable(); $table->boolean('is_lemma')->default(false);
            $table->timestamps();
            $table->index(['form','script']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_forms');
    }
};
