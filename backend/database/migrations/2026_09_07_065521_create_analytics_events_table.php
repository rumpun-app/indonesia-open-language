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
        Schema::create('analytics_events', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); $table->string('event_name'); $table->string('anonymous_id')->nullable(); $table->json('properties')->nullable(); $table->timestamp('occurred_at'); $table->index(['event_name','occurred_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_events');
    }
};
