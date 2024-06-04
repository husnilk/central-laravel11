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

        Schema::create('thesis_defenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_id')->constrained();
            $table->foreignUuid('thesis_rubric_id')->constrained();
            $table->string('file_report')->nullable();
            $table->string('file_slide')->nullable();
            $table->string('file_journal')->nullable();
            $table->integer('status')->default(0);
            $table->dateTime('registered_at');
            $table->integer('method')->default(1);
            $table->date('trial_at')->nullable();
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->foreignUuid('room_id')->constrained();
            $table->text('online_url')->nullable();
            $table->float('score', 10)->nullable();
            $table->string('grade')->nullable();
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
        Schema::dropIfExists('thesis_defenses');
    }
};
