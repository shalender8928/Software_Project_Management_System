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
        Schema::create('project__resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->string('name');
            $table->enum('type', ['material', 'labor', 'equipment', 'consultant']);
            $table->decimal('cost_per_unit', 10, 2);
            $table->integer('availability');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('plan_id')->references('id')->on('project__plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project__resources');
    }
};
