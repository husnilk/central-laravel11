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

        Schema::create('thesis_seminars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_id')->constrained();
            $table->dateTime('registered_at')->nullable();
            $table->integer('method')->default(1);
            $table->dateTime('seminar_at')->nullable();
            $table->foreignUuid('room_id')->nullable()->constrained();
            $table->text('online_url')->nullable();
            $table->string('file_report')->nullable();
            $table->string('file_slide')->nullable();
            $table->string('file_journal')->nullable();
            $table->string('file_attendance')->nullable();
            $table->integer('recommendation')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('thesis_seminars');
    }
};
