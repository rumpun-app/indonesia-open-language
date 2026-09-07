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
        Schema::create('learning_progress', function (Blueprint $table) {
            $table->id(); $table->foreignId('user_id')->constrained()->cascadeOnDelete(); $table->foreignUlid('course_id')->nullable()->constrained()->cascadeOnDelete(); $table->foreignUlid('lesson_id')->nullable()->constrained()->cascadeOnDelete(); $table->unsignedInteger('xp')->default(0); $table->unsignedInteger('streak')->default(0); $table->timestamp('completed_at')->nullable(); $table->unique(['user_id','course_id','lesson_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_progress');
    }
};
