<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyewa_model extends Model
{
    protected $table="penyewa";
    protected $primarykey="id";
    public $timestamps=false;
}
