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
        Schema::create('vip_type_identifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vip_type_id');
            $table->foreign('vip_type_id')->references('id')->on('vip_types');
            $table->unsignedBigInteger('identification_id');
            $table->foreign('identification_id')->references('id')->on('identifications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vip_type_identifications');
    }
};
