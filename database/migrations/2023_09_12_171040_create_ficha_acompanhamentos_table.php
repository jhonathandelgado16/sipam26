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
        Schema::create('ficha_acompanhamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_esposa')->nullable();
            $table->string('contato_esposa')->nullable();
            $table->string('nome_pai')->nullable();
            $table->string('contato_pai')->nullable();
            $table->string('nome_mae')->nullable();
            $table->string('contato_mae')->nullable();
            $table->integer('acidentes_atividades_militares');
            $table->integer('acidentes_atividades_militares_bi')->nullable();
            $table->integer('acidentes_automobilisticos');
            $table->integer('acidentes_automobilisticos_bi')->nullable();
            $table->integer('acidentes_motociclisticos')->nullable();
            $table->integer('acidentes_motociclisticos_bi')->nullable();
            $table->integer('possui_cnh');
            $table->string('categoria_cnh')->nullable();
            $table->string('conducao_motocicleta')->nullable();
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
        Schema::dropIfExists('fichaa_acompanhamentos');
    }
};
