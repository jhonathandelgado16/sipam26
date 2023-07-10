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
        Schema::create('ficha_avaliacao_atributos', function (Blueprint $table) {
            // 1 = SIM
            // 0 = NÃO
            // 2 = NÃO OBSERVADO
            $table->id();
            $table->string('cooperacao')->default('0');
            $table->string('autoconfianca')->default('0');
            $table->string('persistencia')->default('0');
            $table->string('iniciativa')->default('0');
            $table->string('coragem')->default('0');
            $table->string('responsabilidade')->default('0');
            $table->string('disciplina')->default('0');
            $table->string('equilibrio_emocional')->default('0');
            $table->string('entusiasmo_profissional')->default('0');
            $table->string('matricula_cfc')->default('0');
            $table->string('punicao_fase')->default('0');
            $table->string('avaliacao_global')->default('B');
            $table->unsignedBigInteger('militar_id');
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_avaliacao_atributos');
    }
};
