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

        Schema::create('curriculum_plos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('curriculum_id')->constrained()->cascadeOnUpdate();
            $table->string('code');
            $table->text('outcome');
            $table->text('description')->nullable();
            $table->integer('min_grade');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_plos');
    }
};
