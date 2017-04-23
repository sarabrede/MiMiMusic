<?php

use Illuminate\Database\Seeder;

class AlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Album')->insert([
        	'añoAlbum' => \Carbon\Carbon::now(),
        	'tituloAlbum' => 'Tsundere Records',
        	'idUsuario' => 2,
            'precio' => 5.50
        	]);

        DB::table('Album')->insert([
        	'añoAlbum' => \Carbon\Carbon::now(),
        	'tituloAlbum' => 'The Midsummer Station',
        	'idUsuario' => 1,
            'fotoAlbum' => '../audioImages/08.jpg'
        	]);

        DB::table('Album')->insert([
        	'añoAlbum' => \Carbon\Carbon::now(),
        	'tituloAlbum' => 'Si',
        	'idUsuario' => 2,
            'fotoAlbum' => '../audioImages/09.jpg',
            'precio' => 1.25
        	]);
    }
}
