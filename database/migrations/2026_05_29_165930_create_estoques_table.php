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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id('id_estoque'); //PK
            $table->foreignId('id_produto') //FK
                ->constrained('produtos', 'id_produto')
                -> cascadeOnDelete();

            $table->integer('quantidade_atual')->default(0);
            $table->string('quantidade_movimentacao')->default(0);
            $table->date('data_movimentacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
