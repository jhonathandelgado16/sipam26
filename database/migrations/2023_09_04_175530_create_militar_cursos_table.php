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
        Schema::create('militar_cursos', function (Blueprint $table) {
            $table->id();            
            $table->string('data_conclusao');
            $table->string('pontuando', 2)->default('2');
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->unsignedBigInteger('curso_id');
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
        Schema::dropIfExists('militar_cursos');
    }
};
