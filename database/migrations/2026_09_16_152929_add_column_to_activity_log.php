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
        Schema::table('activity_log', function (Blueprint $table) {
        $table->decimal('weight', 8, 2)->nullable();
        $table->string('material')->nullable();
        $table->integer('points')->nullable();
        $table->bigInteger('university_id')->nullable();
        $table->string('serial_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->dropColumn(['weight','material','points','university_id','serial_number',]);
        });
    }
};
