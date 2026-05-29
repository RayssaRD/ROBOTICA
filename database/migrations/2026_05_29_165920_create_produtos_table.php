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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id('id_produto'); //PK
            //FK
            $table->foreignId('id_usuario')
                -> constrained('usuarios','id_usuario')
                ->cascadeOnDelete();
           
            $table->string('nome');
            $table->integer('codigo');
            $table->string('fabricante_fornecedor');
            $table->integer('numero_serie');
            $table->string('compatibilidade_robo' );
            $table->integer('vida_util_hr');
            $table->integer('estoque_minimo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
