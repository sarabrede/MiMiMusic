<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transaccion', function (Blueprint $table) {
            $table->increments('idTransaccion');
            $table->float('totalVenta');
            $table->timestamp('fechaCompra');
            $table->integer('idUsuario')->unsigned();
            //$table->integer('idTarjeta')->unsigned();

            $table->foreign('idUsuario')->references('idUsuario')->on('Usuario');
            //$table->foreign('idTarjeta')->references('idTarjeta')->on('Tarjeta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Transaccion');
    }
}
