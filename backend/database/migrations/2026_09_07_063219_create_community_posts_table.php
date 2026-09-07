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
        Schema::create('community_posts', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignId('author_id')->constrained('users')->cascadeOnDelete(); $table->foreignUlid('language_id')->nullable()->constrained()->nullOnDelete(); $table->foreignUlid('dialect_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title'); $table->text('body'); $table->string('status')->default('published')->index(); $table->string('target_type')->nullable(); $table->string('target_id')->nullable(); $table->index(['target_type','target_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_posts');
    }
};
