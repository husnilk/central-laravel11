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

        Schema::create('course_plan_references', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_plan_id')->constrained()->cascadeOnUpdate();
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->integer('year');
            $table->integer('type');
            $table->integer('primary');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_plan_references');
    }
};
