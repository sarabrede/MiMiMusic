<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function profileUser($user)
    {
		$info = DB::table('Usuario')
		->select('Usuario.*')
		->where('Usuario.idUsuario', '=', $user)
		->get();
        return view('profile', ['info' => $info]);
    }
}
