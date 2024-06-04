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

        Schema::create('course_plan_lecturers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_plan_id')->constrained()->cascadeOnUpdate();
            $table->foreignUuid('lecturer_id')->constrained()->cascadeOnUpdate();
            $table->integer('creator')->default(0);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_plan_lecturers');
    }
};
