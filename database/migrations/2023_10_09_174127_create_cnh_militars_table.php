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
        Schema::create('cnh_militars', function (Blueprint $table) {
            $table->id();
            $table->foreign('cnh_categoria_id')->references('id')->on('cnh_categorias');
            $table->unsignedBigInteger('cnh_categoria_id');
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
        Schema::dropIfExists('cnh_militars');
    }
};
