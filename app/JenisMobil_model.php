<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMobil_model extends Model
{
    protected $table="jenis_mobil";
    protected $primarykey="id";
    public $timestamps=false;
    protected $fillable = [
        'jenis_mobil', 
    ];
}
