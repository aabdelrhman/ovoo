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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('status')->default(1);
            $table->integer('coins_target')->default(0);
            $table->integer('visitors_target')->default(0);
            $table->integer('gifts_target')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('interest_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('level_background_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('room_levels')->onDelete('cascade');
            $table->foreign('level_background_id')->references('id')->on('room_level_backgrounds')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
