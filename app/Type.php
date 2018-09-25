<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    public $timestamps = false;

    protected $fillable = ['intitule','unite_val','unite'];
}
