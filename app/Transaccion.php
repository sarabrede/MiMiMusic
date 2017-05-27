<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'Transaccion';
    protected $primaryKey = 'idTransaccion';
    public $timestamps = false;
}
