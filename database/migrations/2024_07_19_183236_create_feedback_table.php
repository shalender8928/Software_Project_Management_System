<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id('feedbackID');
            $table->unsignedBigInteger('customerID');
            $table->unsignedBigInteger('projectID');
            $table->text('feedbackText');
            $table->integer('rating');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('customerID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('projectID')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
