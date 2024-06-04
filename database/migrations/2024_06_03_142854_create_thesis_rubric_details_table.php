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

        Schema::create('thesis_rubric_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_rubric_id')->constrained();
            $table->text('description');
            $table->float('percentage', 10)->default('0');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_rubric_details');
    }
};
