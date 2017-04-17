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
        DB::table('Cancion')->insert([
        	'tituloCancion' => 'Its Not Like I Like You!',
        	'rutaCancion' => 'audios/Its_Not_Like_I_Like_You.mp3',
        	'idAlbum' => 1,
        	'idGenero' => 9,
        	'fechaPublicacion' => \Carbon\Carbon::now(),
        	'descripcion' => '420% TsundereLevel'
        	]);

        DB::table('Cancion')->insert([
        	'tituloCancion' => 'Shooting Stars (Instrumental)',
        	'rutaCancion' => 'audios/Audiosurf-Bag_Raiders-Shooting_Stars_(Instrumental).mp3',
        	'idAlbum' => 2,
        	'idGenero' => 9,
        	'fechaPublicacion' => \Carbon\Carbon::now(),
        	'descripcion' => 'Its a meme bro'
        	]);

        DB::table('Cancion')->insert([
        	'tituloCancion' => 'Everybodys Circulation (Mashup)',
        	'rutaCancion' => 'audios/Everybodys_Circulation_(Mashup).mp3',
        	'idAlbum' => 3,
        	'idGenero' => 9,
        	'fechaPublicacion' => \Carbon\Carbon::now(),
        	'descripcion' => 'Bst song ever'
        	]);
    }
}
