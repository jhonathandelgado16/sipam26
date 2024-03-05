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
        Schema::table('militars', function (Blueprint $table) {
            //
            $table->foreign('qualificacao_militar_id')->references('id')->on('qualificacao_militars');
            $table->unsignedBigInteger('qualificacao_militar_id')->default(11);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('militars', function (Blueprint $table) {
            //
        });
    }
};
