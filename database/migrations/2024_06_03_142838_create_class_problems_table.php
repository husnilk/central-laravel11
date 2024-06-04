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

        Schema::create('class_problems', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('class_course_id')->constrained();
            $table->foreignUuid('course_enrollment_detail_id')->constrained();
            $table->text('problem');
            $table->text('solution')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_problems');
    }
};
