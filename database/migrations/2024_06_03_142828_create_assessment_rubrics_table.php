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

        Schema::create('assessment_rubrics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('assessment_criteria_id')->constrained();
            $table->string('rubric')->nullable();
            $table->double('grade', 8, 2);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_rubrics');
    }
};
