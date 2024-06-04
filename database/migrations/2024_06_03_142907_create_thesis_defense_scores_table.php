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

        Schema::create('thesis_defense_scores', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_defense_examiner_id')->constrained();
            $table->foreignUuid('thesis_rubric_detail_id')->constrained();
            $table->float('score', 10)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_defense_scores');
    }
};
