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

        Schema::create('thesis_supervisors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_id')->constrained();
            $table->foreignUuid('lecturer_id')->constrained();
            $table->integer('position')->default(0);
            $table->integer('status')->default(0);
            $table->foreignUuid('created_by')->constrained('users');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_supervisors');
    }
};
