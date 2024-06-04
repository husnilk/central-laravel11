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

        Schema::create('class_meetings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('meet_no');
            $table->foreignUuid('class_id')->constrained('class_courses')->cascadeOnUpdate();
            $table->foreignUuid('course_plan_detail_id')->constrained()->cascadeOnUpdate();
            $table->foreignUuid('class_lecturer_id')->constrained()->cascadeOnUpdate();
            $table->text('material_real');
            $table->text('assessment_real');
            $table->integer('method')->default(1);
            $table->string('ol_platform')->nullable();
            $table->string('ol_links')->nullable();
            $table->foreignUuid('room_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->timestamp('meeting_start_at')->nullable();
            $table->timestamp('meeting_end_at')->nullable();
            $table->foreignId('class_course_id');
            $table->foreignId('lecturer_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_meetings');
    }
};
