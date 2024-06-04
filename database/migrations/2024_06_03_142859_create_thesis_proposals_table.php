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

        Schema::create('thesis_proposals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_id')->constrained();
            $table->dateTime('datetime');
            $table->foreignUuid('room_id')->nullable()->constrained();
            $table->string('grade')->nullable();
            $table->foreignUuid('graded_by')->constrained('users');
            $table->integer('status')->default(0);
            $table->string('file_proposal')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_proposals');
    }
};
