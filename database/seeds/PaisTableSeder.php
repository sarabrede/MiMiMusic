<?php

use Illuminate\Database\Seeder;

class PaisTableSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Pais')->insert([
            'idPais' => 1,
        	'nombrePais' => 'México',
        	'iva' => 16.00
        	]);

        DB::table('Pais')->insert([
            'idPais' => 2,
        	'nombrePais' => 'Suiza',
        	'iva' => 8.00
        	]);
    }
}
