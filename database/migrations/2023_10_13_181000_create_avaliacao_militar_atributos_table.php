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
        Schema::create('avaliacao_militar_atributos', function (Blueprint $table) {
            $table->id();
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->unsignedBigInteger('militar_id');
            $table->foreign('atributo_id')->references('id')->on('atributos');
            $table->unsignedBigInteger('atributo_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_id');
            $table->integer('nota');
            $table->integer('situacao');
            $table->string('fase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacao_militar_atributos');
    }
};
