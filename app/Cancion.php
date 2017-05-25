<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancion extends Model
{
    protected $table = 'Cancion';
    protected $primaryKey = 'idCancion';
    public $timestamps = false;
}
