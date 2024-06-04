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

        Schema::create('counselling_logbook_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('no')->default(1);
            $table->foreignUuid('counselling_logbook_id')->constrained();
            $table->foreignUuid('user_id')->constrained();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counselling_logbook_details');
    }
};
