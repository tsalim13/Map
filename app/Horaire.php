<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{
    protected $table = 'horaires';
    public $timestamps = false;

    protected $fillable = ['debut','fin'];
}
