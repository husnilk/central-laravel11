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

        Schema::create('assessment_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_plan_assessment_id')->constrained()->cascadeOnUpdate();
            $table->foreignUuid('course_plan_lo_id')->constrained()->cascadeOnUpdate();
            $table->double('percentage', 8, 2);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_details');
    }
};
