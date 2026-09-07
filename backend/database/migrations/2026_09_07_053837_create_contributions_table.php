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
        Schema::create('contributions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->string('type'); $table->string('status')->default('draft')->index();
            $table->string('target_type')->nullable(); $table->string('target_id')->nullable();
            $table->json('change_set'); $table->text('reason')->nullable(); $table->json('evidence')->nullable();
            $table->timestamp('submitted_at')->nullable(); $table->index(['target_type','target_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
