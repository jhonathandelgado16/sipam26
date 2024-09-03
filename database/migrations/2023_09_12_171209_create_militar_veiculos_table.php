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
        Schema::create('militar_veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->string('marca');
            $table->string('ano');
            $table->string('cor');
            $table->integer('documentacao')->length(2);
            $table->string('pneus')->length(2);
            $table->string('farois')->length(2);
            $table->string('luzes_sinalizacao')->length(2);
            $table->integer('retrovisores')->length(2);
            $table->string('triangulo_sinalizacao')->length(2);
            $table->string('parabrisa_limpador')->length(2);
            $table->string('capacete')->length(2);
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
        Schema::dropIfExists('militar_veiculos');
    }
};
