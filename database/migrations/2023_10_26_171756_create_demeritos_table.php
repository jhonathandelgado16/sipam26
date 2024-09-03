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
        Schema::create('demeritos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->decimal('pontos_demerito', 5, 2);
            $table->foreign('posto_id')->references('id')->on('postos');
            $table->unsignedBigInteger('posto_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demeritos');
    }
};
