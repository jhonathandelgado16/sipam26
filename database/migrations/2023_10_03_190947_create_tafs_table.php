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
        Schema::create('tafs', function (Blueprint $table) {
            $table->id();
            $table->foreign('taf_mencao_id')->references('id')->on('taf_mencaos');
            $table->unsignedBigInteger('taf_mencao_id');
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->unsignedBigInteger('militar_id');
            $table->foreign('publicacao_id')->references('id')->on('publicacaos');
            $table->unsignedBigInteger('publicacao_id');
            $table->foreign('taf_numero_id')->references('id')->on('taf_numeros');
            $table->unsignedBigInteger('taf_numero_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tafs');
    }
};
