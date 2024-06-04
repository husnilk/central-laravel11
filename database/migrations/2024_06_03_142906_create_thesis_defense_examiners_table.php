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

        Schema::create('thesis_defense_examiners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_defense_id')->constrained();
            $table->foreignUuid('examiner_id')->constrained('lecturers');
            $table->integer('status')->default(0);
            $table->integer('position')->default(0);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('thesis_defense_examiners');
    }
};
