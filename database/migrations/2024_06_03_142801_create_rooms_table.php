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

        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('building_id')->constrained();
            $table->string('name');
            $table->integer('floor')->nullable();
            $table->integer('number')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('size')->nullable();
            $table->string('location')->nullable();
            $table->integer('public')->nullable();
            $table->integer('status')->nullable();
            $table->integer('availability')->default(1);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
