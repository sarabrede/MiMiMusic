<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Usuario')->insert([
            'idUsuario' => '1',
        	'nombreUsuario' => 'sarabrede',
        	'correoElectronico' => 'sara_brede@hotmail.com',
        	'contraseña' => 'uwu',
            'nombreCompleto' => 'Sara Victoria Brede Treviño', 
        	'fechaCreacion' => \Carbon\Carbon::now()
        	]);

        DB::table('Usuario')->insert([
            'idUsuario' => '2',
        	'nombreUsuario' => 'EdgarMtz1807',
        	'correoElectronico' => 'ALFREDO_950207@hotmail.com',
        	'contraseña' => 'si',
            'nombreCompleto' => 'Edgar Alfredo Martínez Monjarás', 
        	'fechaCreacion' => \Carbon\Carbon::now()
        	]);
    }
}
