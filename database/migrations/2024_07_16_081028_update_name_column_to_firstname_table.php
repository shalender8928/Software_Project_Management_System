<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Debugging: Check if the column exists before renaming
        $columns = Schema::getColumnListing('users');
        dd($columns); // This will output the columns and stop the execution

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'firstname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('firstname', 'name');
        });
    }
};
