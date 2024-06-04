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

        Schema::create('thesis_logbooks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_id')->constrained();
            $table->foreignUuid('supervisor_id')->constrained('thesis_supervisors');
            $table->date('date');
            $table->text('progress');
            $table->text('problem')->nullable();
            $table->string('file_progress')->nullable();
            $table->foreignUuid('supervised_by')->nullable()->constrained('thesis_supervisors');
            $table->dateTime('supervised_at')->nullable();
            $table->text('notes')->nullable();
            $table->string('file_notes')->nullable();
            $table->integer('status')->default(0);
            $table->foreignId('thesis_supervisor_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_logbooks');
    }
};
