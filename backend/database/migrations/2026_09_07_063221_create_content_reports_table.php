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
        Schema::create('content_reports', function (Blueprint $table) {
            $table->ulid('id')->primary(); $table->foreignId('reporter_id')->constrained('users')->cascadeOnDelete(); $table->string('reportable_type'); $table->string('reportable_id'); $table->string('reason'); $table->text('details')->nullable(); $table->string('status')->default('open')->index(); $table->text('resolution')->nullable(); $table->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete(); $table->index(['reportable_type','reportable_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_reports');
    }
};
