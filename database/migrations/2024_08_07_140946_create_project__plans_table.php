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
        Schema::create('project__plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('deadline');
            $table->enum('status', ['draft', 'approved', 'rejected'])->default('draft');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
<<<<<<< HEAD
            $table->timestamp('approved_on')->nullable();
=======
            $table->unsignedBigInteger('rejected_by')->nullable();
            $table->timestamp('approved_on')->nullable();
            $table->timestamp('rejected_on')->nullable();
>>>>>>> b260690166f437c962fb8f5a07530bce5cae6fac
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
<<<<<<< HEAD
=======
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
>>>>>>> b260690166f437c962fb8f5a07530bce5cae6fac
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project__plans');
    }
};
