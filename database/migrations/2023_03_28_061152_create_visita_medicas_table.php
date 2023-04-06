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
        Schema::create('visita_medicas', function (Blueprint $table) {
            $table->id();
            $table->date('data_visita');
            $table->string('descricao');
            $table->unsignedBigInteger('militar_id');
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visita_medicas');
    }
};
