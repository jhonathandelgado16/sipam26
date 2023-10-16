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
        Schema::create('curso_formacao_militars', function (Blueprint $table) {
            $table->id();
            $table->foreign('curso_formacao_id')->references('id')->on('curso_formacaos');
            $table->unsignedBigInteger('curso_formacao_id');
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->unsignedBigInteger('militar_id');
            $table->foreign('publicacao_id')->references('id')->on('publicacaos');
            $table->unsignedBigInteger('publicacao_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_formacao_militars');
    }
};
