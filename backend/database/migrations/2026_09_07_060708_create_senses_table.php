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
        Schema::create('senses', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignUlid('lexical_entry_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('position')->default(1); $table->text('definition'); $table->text('translation')->nullable();
            $table->string('register')->nullable(); $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['lexical_entry_id','position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senses');
    }
};
