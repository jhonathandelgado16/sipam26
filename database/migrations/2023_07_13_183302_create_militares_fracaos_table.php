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
        Schema::create('militares_fracaos', function (Blueprint $table) {
            $table->id();
            $table->foreign('fracao_id')->references('id')->on('fracaos');
            $table->unsignedBigInteger('fracao_id');
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
        Schema::dropIfExists('militares_fracaos');
    }
};
