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

        Schema::create('course_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_id')->constrained()->cascadeOnUpdate();
            $table->integer('rev');
            $table->string('code');
            $table->string('name');
            $table->string('alias_name')->nullable();
            $table->integer('credit');
            $table->integer('semester');
            $table->integer('mandatory');
            $table->text('description');
            $table->string('ilearn_url')->nullable();
            $table->foreignUuid('validated_by')->nullable()->constrained('lecturers')->cascadeOnUpdate();
            $table->timestamp('validated_at')->nullable();
            $table->text('learning_strategy')->nullable();
            $table->text('learning_management')->nullable();
            $table->text('participant')->nullable();
            $table->text('class_observation')->nullable();
            $table->text('constraint')->nullable();
            $table->text('improvement')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_plans');
    }
};
