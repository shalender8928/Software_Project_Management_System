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
            $table->string('lastname')->after('firstname');
            $table->string('phone')->after('email');
            $table->string('gender')->after('password');
            $table->integer('age')->after('gender');
            $table->string('image')->after('age')->nullable();
            $table->string('registered_by')->default('self')->after('image');
            $table->string('updated_by')->default('self')->after('registered_by');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('lastname');
            $table->dropColumn('phone');
            $table->dropColumn('gender');
            $table->dropColumn('age');
            $table->dropColumn('image');
            $table->dropColumn('registered_by');
            $table->dropColumn('updated_by');

        });
    }
};
