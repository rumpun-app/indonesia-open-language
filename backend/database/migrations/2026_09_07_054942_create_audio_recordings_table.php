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
        Schema::create('audio_recordings', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignUlid('speaker_id')->constrained()->cascadeOnDelete(); $table->foreignUlid('language_id')->constrained()->cascadeOnDelete(); $table->foreignUlid('dialect_id')->nullable()->constrained()->nullOnDelete(); $table->text('text')->nullable(); $table->string('storage_path'); $table->string('processing_status')->default('uploaded'); $table->string('review_status')->default('pending'); $table->string('license')->nullable(); $table->timestamp('recorded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio_recordings');
    }
};
