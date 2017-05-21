<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'Usuario';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false;
}
