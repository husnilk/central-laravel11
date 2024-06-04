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

        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary()->foreign('students.id');
            $table->string('nik')->nullable();
            $table->string('nim')->unique();
            $table->string('name');
            $table->integer('year')->nullable();
            $table->enum('gender', ["M","F"])->nullable();
            $table->date('birthday')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->foreignUuid('department_id')->constrained();
            $table->string('photo')->nullable();
            $table->integer('marital_status')->nullable();
            $table->integer('religion');
            $table->integer('status')->default(1);
            $table->foreignUuid('counselor_id')->nullable()->constrained('lecturers');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
