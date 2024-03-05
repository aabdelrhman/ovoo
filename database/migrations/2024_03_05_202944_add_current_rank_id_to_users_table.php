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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('current_rank_id')->nullable();
            $table->foreign('current_rank_id')->references('id')->on('ranks')->onDelete('set null');
            $table->unsignedBigInteger('next_rank_id')->nullable();
            $table->foreign('next_rank_id')->references('id')->on('ranks')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
