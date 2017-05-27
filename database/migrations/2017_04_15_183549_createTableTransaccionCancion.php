<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaccionCancion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TransaccionAlbum', function (Blueprint $table) {
            $table->increments('idAlbumTransaccion');
            $table->integer('idAlbum')->unsigned();
            $table->integer('idTransaccion')->unsigned();

            $table->foreign('idAlbum')->references('idAlbum')->on('Album');
            $table->foreign('idTransaccion')->references('idTransaccion')->on('Transaccion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TransaccionAlbum');
    }
}
