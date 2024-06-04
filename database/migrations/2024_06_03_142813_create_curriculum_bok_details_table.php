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

        Schema::create('curriculum_bok_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('curriculum_bok_id')->constrained()->cascadeOnUpdate();
            $table->text('lo');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_bok_details');
    }
};
