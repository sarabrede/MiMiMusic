<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('UsuarioComentaCancion')->insert([
        	'idComentario' => '1',
        	'fechaComentario' => \Carbon\Carbon::now(),
        	'comentario' => 'Muy buena la rola!',
        	'idUsuario' => 1,
            'idCancion' => 7
        	]);

          DB::table('UsuarioComentaCancion')->insert([
        	'idComentario' => '2',
        	'fechaComentario' => \Carbon\Carbon::now(),
        	'comentario' => 'No puedo dejar de escucharla.',
        	'idUsuario' => 1,
            'idCancion' => 7
        	]);
    }
}
