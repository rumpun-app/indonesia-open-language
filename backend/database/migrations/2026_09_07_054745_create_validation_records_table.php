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
        Schema::create('validation_records', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('validatable_type'); $table->string('validatable_id');
            $table->foreignId('validator_id')->constrained('users')->cascadeOnDelete();
            $table->string('level'); $table->string('status'); $table->text('reason')->nullable(); $table->json('evidence')->nullable();
            $table->timestamps();
            $table->index(['validatable_type','validatable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validation_records');
    }
};
