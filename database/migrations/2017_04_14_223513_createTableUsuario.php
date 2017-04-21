<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Usuario', function (Blueprint $table) {
            $table->increments('idUsuario');
            $table->string('nombreUsuario', 50)->unique();
            $table->string('correoElectronico', 50)->unique();
            $table->string('contraseña', 32);
            $table->string('fotoPerfil')->default('images/defaultUser.png');
            $table->string('fotoBanner')->default('images/defaultUser.png');
            $table->enum('tipo', ['Solista', 'Banda'])->nullable();
            $table->integer('idPais')->unsigned()->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamp('fechaCreacion');

            $table->foreign('idPais')->references('idPais')->on('Pais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('Usuario');
    }
}
