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
        Schema::create('reputation_events', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignId('user_id')->constrained()->cascadeOnDelete(); $table->string('event_type'); $table->integer('points'); $table->string('subject_type')->nullable(); $table->string('subject_id')->nullable(); $table->json('metadata')->nullable(); $table->index(['subject_type','subject_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reputation_events');
    }
};
