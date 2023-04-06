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
        Schema::create('fato_observados', function (Blueprint $table) {
            $table->id();
            $table->string('fato_observado');
            $table->string('data');
            $table->string('militar_que_observou');
            $table->string('descricao');
            $table->unsignedBigInteger('militar_id');
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fato_observados');
    }
};
