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

        Schema::create('counselling_logbooks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained();
            $table->foreignUuid('counsellor_id')->constrained('lecturers');
            $table->foreignUuid('counselling_topic_id')->constrained('counselling_categories');
            $table->foreignUuid('period_id')->constrained();
            $table->date('date');
            $table->integer('status')->default(0);
            $table->string('file')->nullable();
            $table->foreignId('counselling_category_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counselling_logbooks');
    }
};
