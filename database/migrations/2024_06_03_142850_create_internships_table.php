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

        Schema::create('internships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('internship_proposal_id')->constrained();
            $table->foreignUuid('student_id')->constrained();
            $table->foreignUuid('advisor_id')->nullable()->constrained('lecturers');
            $table->enum('status', ["accepted","rejected","ongoing","seminar","administration","finished","cancelled"]);
            $table->date('start_at');
            $table->date('end_at')->nullable();
            $table->text('report_title')->nullable();
            $table->date('seminar_date')->nullable();
            $table->foreignUuid('seminar_room_id')->constrained('rooms');
            $table->string('link_seminar')->nullable();
            $table->date('seminar_deadline')->nullable();
            $table->string('attendees_list')->nullable();
            $table->string('internship_score')->nullable();
            $table->string('activity_report')->nullable();
            $table->string('news_event')->nullable();
            $table->string('work_report')->nullable();
            $table->string('certificate')->nullable();
            $table->string('report_receipt')->nullable();
            $table->string('grade')->nullable();
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
        Schema::dropIfExists('internships');
    }
};
