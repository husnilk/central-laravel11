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

        Schema::create('internship_seminar_audiences', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('internship_id')->constrained();
            $table->foreignUuid('student_id')->constrained();
            $table->enum('role', ['audience', 'moderator', 'questioner']);
            $table->text('question')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_seminar_audiences');
    }
};
