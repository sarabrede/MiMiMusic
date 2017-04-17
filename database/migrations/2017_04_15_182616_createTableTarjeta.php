<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTarjeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tarjeta', function (Blueprint $table) {
            $table->increments('idTarjeta');
            $table->enum('TipoTarjeta', ['Visa', 'MasterCard']);
            $table->integer('numeroTarjeta');
            $table->integer('idUsuario')->unsigned();

            $table->foreign('idUsuario')->references('idUsuario')->on('Usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tarjeta');
    }
}
