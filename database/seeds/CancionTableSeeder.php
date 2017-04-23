<?php

use Illuminate\Database\Seeder;

class CancionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'http://127.0.0.1:8080/audios/';

        DB::table('Cancion')->insert([
            'tituloCancion' => 'Cornman',
            'rutaCancion' => $path.'4._Cornman.mp3',
            'idAlbum' => 1,
            'idGenero' => 1,
            'fechaPublicacion' => \Carbon\Carbon::now(),
            'descripcion' => 'Mexicanota',
            'visitas' => 1
            ]);

        DB::table('Cancion')->insert([
            'tituloCancion' => 'Introducción A La Cartografía',
            'rutaCancion' => $path.'05_Introducción_A_La_Cartografía.mp3',
            'idAlbum' => 1,
            'idGenero' => 1,
            'fechaPublicacion' => \Carbon\Carbon::now(),
            'descripcion' => 'Sadboi',
            'visitas' => 10
            ]);

        DB::table('Cancion')->insert([
            'tituloCancion' => 'Barracuda',
            'rutaCancion' => $path.'Barracuda.mp3',
            'idAlbum' => 1,
            'idGenero' => 3,
            'fechaPublicacion' => \Carbon\Carbon::now(),
            'descripcion' => 'uuuuuhhhh Barracuda'
            ]);

        DB::table('Cancion')->insert([
            'tituloCancion' => 'Cliffs of dover',
            'rutaCancion' => $path.'Cliffs_of_dover.mp3',
            'idAlbum' => 1,
            'idGenero' => 2,
            'fechaPublicacion' => \Carbon\Carbon::now(),
            'descripcion' => 'bst rock song evah',
            'visitas' => 14
            ]);

        DB::table('Cancion')->insert([
            'tituloCancion' => 'Cruel angel´s tesis',
            'rutaCancion' => $path.'Cruel_angel´s_tesis.mp3',
            'idAlbum' => 1,
            'idGenero' => 6,
            'fechaPublicacion' => \Carbon\Carbon::now(),
            'descripcion' => 'subete al eva shinji'
            ]);

        DB::table('Cancion')->insert([
            'tituloCancion' => 'Everybodys Circulation (Mashup)',
            'rutaCancion' => $path.'Everybodys_Circulation_(Mashup).mp3',
            'idAlbum' => 3,
            'idGenero' => 7,
            'fechaPublicacion' => \Carbon\Carbon::now(),
            'descripcion' => 'Bst song ever',
            'visitas' => 114
            ]);

        DB::table('Cancion')->insert([
        	'tituloCancion' => 'Its Not Like I Like You!',
        	'rutaCancion' => $path.'Its_Not_Like_I_Like_You.mp3',
        	'idAlbum' => 1,
        	'idGenero' => 9,
        	'fechaPublicacion' => \Carbon\Carbon::now(),
        	'descripcion' => '420% TsundereLevel',
            'visitas' => 10
        	]);

        DB::table('Cancion')->insert([
        	'tituloCancion' => 'Shooting Stars (Instrumental)',
        	'rutaCancion' => $path.'Shooting_Stars_(Instrumental).mp3',
        	'idAlbum' => 2,
        	'idGenero' => 9,
        	'fechaPublicacion' => \Carbon\Carbon::now(),
        	'descripcion' => 'Its a meme bro'
        	]);

        DB::table('Cancion')->insert([
            'tituloCancion' => 'Under pressure',
            'rutaCancion' => $path.'Under_pressure.mp3',
            'idAlbum' => 2,
            'idGenero' => 9,
            'fechaPublicacion' => \Carbon\Carbon::now(),
            'descripcion' => 'UNDER PRESSURE'
            ]);

        DB::table('Cancion')->insert([
            'tituloCancion' => 'Viaje al centro de mi corazon',
            'rutaCancion' => $path.'Viaje_al_centro_de_mi_corazon.mp3',
            'idAlbum' => 2,
            'idGenero' => 9,
            'fechaPublicacion' => \Carbon\Carbon::now(),
            'descripcion' => 'rap master'
            ]);
    }
}
