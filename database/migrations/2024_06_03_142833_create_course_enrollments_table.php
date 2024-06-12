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

        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained()->cascadeOnUpdate();
            $table->foreignUuid('period_id')->constrained()->cascadeOnUpdate();
            $table->foreignUuid('counselor_id')->nullable()->constrained('lecturers')->cascadeOnUpdate();
            $table->integer('status')->default(1);
            $table->string('mid_term_passcode')->nullable();
            $table->string('final_term_passcode')->nullable();
            $table->date('registered_at')->nullable();
            $table->double('gpa', 8, 2)->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_enrollments');
    }
};
