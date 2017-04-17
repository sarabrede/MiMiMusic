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
        	'nombreUsuario' => 'sarabrede',
        	'correoElectronico' => 'sara_brede@hotmail.com',
        	'contraseña' => 'uwu',
        	'fechaCreacion' => \Carbon\Carbon::now()
        	]);

        DB::table('Usuario')->insert([
        	'nombreUsuario' => 'EdgarMtz1807',
        	'correoElectronico' => 'ALFREDO_950207@hotmail.com',
        	'contraseña' => 'si',
        	'fechaCreacion' => \Carbon\Carbon::now()
        	]);
    }
}
