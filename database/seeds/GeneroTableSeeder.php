<?php

use Illuminate\Database\Seeder;

class GeneroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('Genero')->insert([
       		[
        		'nombreGenero' => 'Rock'
        	],
        	[
        		'nombreGenero' => 'Pop'
        	],
        	[
        		'nombreGenero' => 'Metal'
        	],
        	[
        		'nombreGenero' => 'Blues'
        	],
        	[
        		'nombreGenero' => 'Jazz'
        	],
        	[
        		'nombreGenero' => 'Rap'
        	],
        	[
        		'nombreGenero' => 'Country'
        	],
        	[
        		'nombreGenero' => 'Hip Hop'
        	],
            [
                'nombreGenero' => 'Other'
            ]
        	]);

      
    }
}
