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

        Schema::create('class_courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_id')->constrained()->cascadeOnUpdate();
            $table->foreignUuid('period_id')->constrained()->cascadeOnUpdate();
            $table->foreignUuid('course_plan_id')->constrained()->cascadeOnUpdate();
            $table->string('name');
            $table->string('course_code')->nullable();
            $table->string('course_name')->nullable();
            $table->integer('course_credits')->nullable();
            $table->integer('course_semester')->nullable();
            $table->text('meeting_nonconformity')->nullable();
            $table->boolean('meeting_verified')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_courses');
    }
};
