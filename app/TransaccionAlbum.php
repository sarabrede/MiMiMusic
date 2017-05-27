<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaccionAlbum extends Model
{
    protected $table = 'TransaccionAlbum';
    protected $primaryKey = 'idAlbumTransaccion';
    public $timestamps = false;
}
