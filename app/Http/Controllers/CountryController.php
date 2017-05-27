<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CountryController extends Controller
{
    public function getCountries()
	{
		$countries = DB::table('Pais')
		->select('Pais.*')
		->get();
		return $countries;
	}
}
