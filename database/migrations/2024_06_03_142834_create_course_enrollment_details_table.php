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

        Schema::create('course_enrollment_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_enrollment_id')->constrained()->cascadeOnUpdate();
            $table->foreignUuid('class_id')->constrained('class_courses')->cascadeOnUpdate();
            $table->integer('status')->default(1);
            $table->integer('in_transcript')->default(1);
            $table->double('weight')->nullable();
            $table->double('grade')->nullable();
            $table->foreignId('class_course_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_enrollment_details');
    }
};
