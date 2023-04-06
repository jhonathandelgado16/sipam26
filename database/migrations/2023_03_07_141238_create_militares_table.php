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
        Schema::create('militares', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nome_de_guerra');
            $table->integer('numero');
            $table->string('cpf', 11)->unique();
            $table->string('idt_militar');
            $table->string('endereco');
            $table->string('contato');
            $table->string('responsavel');
            $table->unsignedBigInteger('subunidade_id');
            $table->foreign('subunidade_id')->references('id')->on('subunidades');
            $table->unsignedBigInteger('pelotao_id');
            $table->foreign('pelotao_id')->references('id')->on('pelotaos');
            $table->unsignedBigInteger('posto_id');
            $table->foreign('posto_id')->references('id')->on('postos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('militares');
    }
};
