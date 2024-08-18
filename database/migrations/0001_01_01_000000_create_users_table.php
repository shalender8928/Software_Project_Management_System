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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('firstname'); // Changed from 'name' to 'firstname'
=======
            $table->string('firstname'); // Changed from 'name' to
>>>>>>> b260690166f437c962fb8f5a07530bce5cae6fac
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phone')->nullable(); // Added

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gender')->nullable(); // Added
            $table->integer('age')->nullable(); // Added
            $table->string('image')->nullable(); // Added
            $table->string('registered_by')->default('self'); // Added
            $table->string('updated_by')->default('self'); // Added
            $table->rememberToken();

            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
