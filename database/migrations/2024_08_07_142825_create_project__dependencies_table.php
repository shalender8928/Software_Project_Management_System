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
        Schema::create('project__dependencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('preceding_task_id');
            $table->unsignedBigInteger('dependent_task_id');
            $table->enum('dependency_type', ['start_to_start', 'finished_to_start', 'start_to_finish', 'finished_to_finish']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('plan_id')->references('id')->on('project__plans')->onDelete('cascade');
            $table->foreign('preceding_task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('dependent_task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project__dependencies');
    }
};
