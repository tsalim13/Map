<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'supports';
    public $timestamps = false;

    protected $fillable = ['intitule'];
}
