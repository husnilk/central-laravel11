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

        Schema::create('thesis_data_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('thesis_id')->constrained();
            $table->foreignUuid('supervisor_id')->constrained('thesis_supervisors');
            $table->dateTime('request_at');
            $table->text('requested_data');
            $table->text('request_to_person')->nullable();
            $table->text('request_to_position')->nullable();
            $table->text('request_to_org')->nullable();
            $table->text('request_to_address')->nullable();
            $table->integer('status')->default(0);
            $table->foreignId('student_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_data_requests');
    }
};
