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
        Schema::create('militar_demeritos', function (Blueprint $table) {
            $table->id();
            $table->string('publicacao');
            $table->foreign('demerito_id')->references('id')->on('demeritos');
            $table->unsignedBigInteger('demerito_id');
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->unsignedBigInteger('militar_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('militar_demeritos');
    }
};
