<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Face extends Model
{
    protected $table = 'faces';
    public $timestamps = false;

    protected $fillable = ['id_emplacement','id_support','codif','etat','tarif_unite'];
}
