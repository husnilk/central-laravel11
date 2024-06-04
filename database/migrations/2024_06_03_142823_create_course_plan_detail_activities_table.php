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

        Schema::create('course_plan_detail_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_plan_detail_id')->constrained()->cascadeOnUpdate();
            $table->integer('activity');
            $table->string('method')->nullable();
            $table->integer('est_time')->nullable();
            $table->text('student_activity');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_plan_detail_activities');
    }
};
