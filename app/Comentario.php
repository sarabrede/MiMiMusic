<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
 	protected $table = 'UsuarioComentaCancion';
    protected $primaryKey = 'idComentario';
    public $timestamps = false;
}
