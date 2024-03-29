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
        Schema::create('militar_escolaridades', function (Blueprint $table) {
            $table->id();
            $table->foreign('escolaridade_id')->references('id')->on('escolaridades');
            $table->unsignedBigInteger('escolaridade_id');
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->unsignedBigInteger('militar_id');
            $table->string('instituicao_ensino');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('militar_escolaridades');
    }
};
