<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'Album';
    protected $primaryKey = 'idAlbum';
    public $timestamps = false;
}
