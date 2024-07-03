<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('tamanho');
            $table->string('referencia');
            $table->string('categoria');
            $table->string('cor');
            $table->integer('estoque');
            $table->double('preco',10,2);
            $table->double('preco_venda',10,2)->nullable();
            $table->longText('imagem');
            $table->string('marca');
            $table->string('tamanho_salto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
