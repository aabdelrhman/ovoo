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
        Schema::create('room_level_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('id')->on('room_levels')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_level_backgrounds');
    }
};
