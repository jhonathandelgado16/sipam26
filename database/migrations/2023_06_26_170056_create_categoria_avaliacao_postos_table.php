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
        Schema::create('categoria_avaliacao_postos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posto_id');
            $table->foreign('posto_id')->references('id')->on('postos');
            $table->unsignedBigInteger('categoria_avaliacao_id');
            $table->foreign('categoria_avaliacao_id')->references('id')->on('categoria_avaliacaos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_avaliacao_postos');
    }
};
