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
            $table->date('data_nascimento')->default('2004-01-01');
            $table->string('tipo_sanguineo')->default('O+');
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
