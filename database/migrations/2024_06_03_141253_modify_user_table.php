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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('username')->nullable()->after('id');
            $table->integer('type')->default(1)->after('password');
            $table->integer('active')->default(1)->after('type');
            $table->string('avatar')->nullable()->after('active');
            $table->text('profile_photo')->nullable()->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('type');
            $table->dropColumn('active');
            $table->dropColumn('avatar');
            $table->dropColumn('profile_photo');
        });
    }
};
