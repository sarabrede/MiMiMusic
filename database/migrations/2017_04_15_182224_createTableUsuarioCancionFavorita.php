<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuarioCancionFavorita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UsuarioCancionFavorita', function (Blueprint $table) {
            $table->integer('idUsuario')->unsigned();
            $table->integer('idCancion')->unsigned();

            $table->foreign('idUsuario')->references('idUsuario')->on('Usuario');
            $table->foreign('idCancion')->references('idCancion')->on('Cancion');

            $table->primary(['idUsuario', 'idCancion']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UsuarioCancionFavorita');
    }
}
