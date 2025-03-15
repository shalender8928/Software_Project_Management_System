<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        /*Schema::table('project__plans', function (Blueprint $table) {
            // Adding 'rejected_by' column after 'approved_by'
            $table->unsignedBigInteger('rejected_by')->nullable()->after('approved_by');
            
            // Adding 'rejected_on' column after 'approved_on'
            $table->timestamp('rejected_on')->nullable()->after('approved_on');
            
            // Adding foreign key constraint to 'rejected_by'
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
        });*/
    }
    public function down()
    {
        /*Schema::table('project__plans', function (Blueprint $table) {
            // Dropping the 'rejected_by' column and its foreign key constraint
            $table->dropForeign(['rejected_by']);
            $table->dropColumn('rejected_by');
            
            // Dropping the 'rejected_on' column
            $table->dropColumn('rejected_on');
        });*/
    }

};
