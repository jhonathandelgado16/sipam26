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
        Schema::create('atributo_avaliacaos', function (Blueprint $table) {
            $table->id();
            $table->foreign('categoria_avaliacao_id')->references('id')->on('categoria_avaliacaos');
            $table->unsignedBigInteger('categoria_avaliacao_id');
            $table->foreign('atributo_id')->references('id')->on('atributos');
            $table->unsignedBigInteger('atributo_id');
            $table->string('status', 2)->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atributos_avaliacaos');
    }
};
