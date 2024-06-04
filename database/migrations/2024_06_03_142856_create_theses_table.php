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

        Schema::create('theses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('topic_id')->constrained('thesis_topics');
            $table->foreignUuid('student_id')->constrained();
            $table->text('title')->nullable();
            $table->text('abstract')->nullable();
            $table->date('start_at')->nullable();
            $table->integer('status')->default(0);
            $table->string('grade')->nullable();
            $table->unsignedBigInteger('grade_by')->nullable();
            $table->foreignUuid('created_by')->constrained('users');
            $table->foreignId('thesis_topic_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theses');
    }
};
