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
        Schema::disableForeignKeyConstraints();

        Schema::create('thesis_seminar_reviewers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_seminar_id')->constrained();
            $table->foreignUuid('reviewer_id')->constrained('lecturers');
            $table->integer('status')->default(1);
            $table->string('position')->nullable();
            $table->integer('recommendation')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_seminar_reviewers');
    }
};
