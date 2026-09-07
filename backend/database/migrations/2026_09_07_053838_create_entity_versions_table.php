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
        Schema::create('entity_versions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('versionable_type'); $table->string('versionable_id'); $table->unsignedInteger('version');
            $table->json('snapshot'); $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignUlid('source_id')->nullable()->constrained('sources')->nullOnDelete(); $table->text('reason')->nullable();
            $table->unique(['versionable_type','versionable_id','version']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_versions');
    }
};
