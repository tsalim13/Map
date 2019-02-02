<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarifs';
    public $timestamps = false;

    protected $fillable = ['id_face','id_horaire','tarif_horaire'];
}
