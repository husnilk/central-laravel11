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

        Schema::create('internship_proposals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('company_id')->constrained('internship_companies');
            $table->integer('type')->default(1);
            $table->string('title');
            $table->text('job_desc')->nullable();
            $table->date('start_at');
            $table->date('end_at');
            $table->enum('status', ['draft', 'open', 'proposed'])->default('draft');
            $table->text('note')->nullable();
            $table->integer('active')->default(1);
            $table->string('response_letter')->nullable();
            $table->text('background')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_proposals');
    }
};
