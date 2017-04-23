<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaisTableSeder::class);
    	$this->call(UsersTableSeeder::class);
    	$this->call(AlbumTableSeeder::class);
    	$this->call(GeneroTableSeeder::class);
        $this->call(CancionTableSeeder::class);
        $this->call(CommentTableSeeder::class);
    }
}
