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
        Schema::create('pelotaos', function (Blueprint $table) {
            $table->id();
            $table->string('pelotao');
            $table->string('cmt_pelotao');
            $table->unsignedBigInteger('subunidade_id');
            $table->foreign('subunidade_id')->references('id')->on('subunidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelotaos');
    }
};
