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
        Schema::create('language_script', function (Blueprint $table) {
            $table->foreignUlid('language_id')->constrained()->cascadeOnDelete(); $table->foreignUlid('script_id')->constrained()->cascadeOnDelete(); $table->boolean('is_primary')->default(false); $table->primary(['language_id','script_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_script');
    }
};
