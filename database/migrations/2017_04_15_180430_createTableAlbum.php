<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAlbum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Album', function (Blueprint $table) {
            $table->increments('idAlbum');
            $table->string('fotoAlbum')->default('audios/AlbumImages/default.jpg');
            $table->date('añoAlbum');
            $table->string('tituloAlbum', 50);
            $table->integer('idUsuario')->unsigned();
            $table->boolean('activo')->default(1);

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
        Schema::dropIfExists('Album');
    }
}
