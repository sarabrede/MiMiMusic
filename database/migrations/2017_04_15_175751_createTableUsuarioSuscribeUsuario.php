<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuarioSuscribeUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UsuarioSuscribeUsuario', function (Blueprint $table) {
           $table->integer('Suscripcion')->unsigned();
           $table->integer('Suscriptor')->unsigned();

           $table->foreign('Suscripcion')->references('idUsuario')->on('Usuario');
           $table->foreign('Suscriptor')->references('idUsuario')->on('Usuario');

           $table->primary(['Suscripcion', 'Suscriptor']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UsuarioSuscribeUsuario');
    }
}
