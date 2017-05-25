<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GenreController extends Controller
{
    public function getGenres()
	{
		$genres = DB::table('Genero')
		->select('Genero.*')
		->get();
		return $genres;
	}
}
