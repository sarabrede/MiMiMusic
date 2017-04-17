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
        Schema::create('TransaccionCancion', function (Blueprint $table) {
            $table->integer('idCancion')->unsigned();
            $table->integer('idTransaccion')->unsigned();
            $table->float('subtotalCancion');
            $table->float('totalCancion');

            $table->foreign('idCancion')->references('idCancion')->on('Cancion');
            $table->foreign('idTransaccion')->references('idTransaccion')->on('Transaccion');

            $table->primary(['idCancion', 'idTransaccion']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TransaccionCancion');
    }
}
