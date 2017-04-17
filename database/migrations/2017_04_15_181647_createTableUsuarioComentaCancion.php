<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuarioComentaCancion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UsuarioComentaCancion', function (Blueprint $table) {
            $table->increments('idComentario');
            $table->timestamp('fechaComentario');
            $table->string('comentario');
            $table->integer('idUsuario')->unsigned();
            $table->integer('idCancion')->unsigned();

            $table->foreign('idUsuario')->references('idUsuario')->on('Usuario');
            $table->foreign('idCancion')->references('idCancion')->on('Cancion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UsuarioComentaCancion');
    }
}
