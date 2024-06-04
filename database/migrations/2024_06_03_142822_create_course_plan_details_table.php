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

        Schema::create('course_plan_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_plan_id')->constrained()->cascadeOnUpdate();
            $table->integer('week');
            $table->foreignUuid('course_plan_lo_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->text('grade_indicator')->nullable();
            $table->text('grade_criteria')->nullable();
            $table->text('media')->nullable();
            $table->text('material')->nullable();
            $table->text('reference')->nullable();
            $table->string('method')->nullable();
            $table->integer('activity')->nullable();
            $table->integer('est_time')->nullable();
            $table->text('student_activity')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_plan_details');
    }
};
