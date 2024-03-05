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
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->foreign('militar_id')->references('id')->on('militars');
            $table->unsignedBigInteger('militar_id');
            $table->decimal('nota_final', 5, 2);
            $table->decimal('nota_atitude', 5, 2);
            $table->decimal('nota_conhecimento', 5, 2);
            $table->decimal('nota_habilidade', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rankings');
    }
};
