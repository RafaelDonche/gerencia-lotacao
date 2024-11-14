<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();

            // Dados pessoais
            $table->string('nome');
            $table->string('sobrenome');

            // Salas
            $table->bigInteger('id_primeira_sala')->unsigned()->nullable();
            $table->foreign('id_primeira_sala')->references('id')->on('salas');
            $table->bigInteger('id_segunda_sala')->unsigned()->nullable();
            $table->foreign('id_segunda_sala')->references('id')->on('salas');

            // Espaços de café
            $table->bigInteger('id_primeiro_intervalo')->unsigned()->nullable();
            $table->foreign('id_primeiro_intervalo')->references('id')->on('espaco_cafes');
            $table->bigInteger('id_segundo_intervalo')->unsigned()->nullable();
            $table->foreign('id_segundo_intervalo')->references('id')->on('espaco_cafes');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
