<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCancion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cancion', function (Blueprint $table) {
            $table->increments('idCancion');
            $table->string('tituloCancion', 50);
            $table->string('rutaCancion');
            $table->float('precio')->default(0.0);
            $table->integer('idAlbum')->unsigned();
            $table->integer('idGenero')->unsigned();
            $table->timestamp('fechaPublicacion');
            $table->integer('visitas')->default(0);
            $table->string('descripcion', 100);

            $table->foreign('idAlbum')->references('idAlbum')->on('Album');
            $table->foreign('idGenero')->references('idGenero')->on('Genero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cancion');
    }
}
