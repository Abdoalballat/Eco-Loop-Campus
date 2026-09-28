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
        Schema::create('login', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('university_id')->index()->unique()->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('college')->nullable();
            $table->string('role')->default('student');
            $table->string('zone')->nullable();
            $table->decimal('points',11,3)->nullable()->default(0);
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};
