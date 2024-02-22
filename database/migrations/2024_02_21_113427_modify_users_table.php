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
            $table->string('name')->nullable()->change();
            $table->dropUnique(['email']);
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->string('phone')->nullable();
            $table->integer('verification_code')->nullable();
            $table->enum('active' , [0,1])->default(0)->comment('0 = not active , 1 = active');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('email')->unique()->change();
            $table->string('password')->change();
            $table->dropColumn('phone');
            $table->dropColumn('verification_code');
            $table->dropColumn('active');
            $table->dropForeign('country_id');
            $table->dropColumn('country_id');
        });
    }
};
