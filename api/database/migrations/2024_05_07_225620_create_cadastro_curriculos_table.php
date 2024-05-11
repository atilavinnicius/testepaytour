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
        Schema::create('cadastro_curriculos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('telefone');
            $table->string('cargoDesejado');
            $table->string('escolaridade');
            $table->date('dataEnvio');
            $table->time('horaEnvio');
            $table->string('observacoes')->nullable();
            $table->string('ipCliente');
            $table->string('caminhoArquivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cadastro_curriculos');
    }
};
