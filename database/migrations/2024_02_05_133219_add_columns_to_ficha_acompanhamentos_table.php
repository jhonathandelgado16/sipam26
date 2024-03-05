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
        Schema::table('ficha_acompanhamentos', function (Blueprint $table) {
            //
            $table->integer('qtd_irmaos')->default(0);
            $table->decimal('renda_familiar', 5, 2);
            $table->text('objetivo_de_vida')->default("");
            $table->text('lazer')->default("");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ficha_acompanhamentos', function (Blueprint $table) {
            //
        });
    }
};
