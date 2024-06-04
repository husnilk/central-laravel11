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

        Schema::create('class_attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_enrollment_detail_id')->constrained()->cascadeOnUpdate();
            $table->foreignUuid('class_meeting_id')->constrained()->cascadeOnUpdate();
            $table->integer('status')->default(1);
            $table->integer('meet_no');
            $table->string('device_id')->nullable();
            $table->string('device_name')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('attendance_status')->default(0);
            $table->integer('need_attention')->default(0);
            $table->text('information');
            $table->text('permit_reason')->nullable();
            $table->string('permit_file')->nullable();
            $table->double('rating')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_attendances');
    }
};
