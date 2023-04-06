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
        Schema::create('vacina_aplicadas', function (Blueprint $table) {
            $table->id();
            $table->date('data_aplicacao');
            $table->unsignedBigInteger('militar_id');
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->unsignedBigInteger('vacina_id');
            $table->foreign('vacina_id')->references('id')->on('vacinas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacina_aplicadas');
    }
};
