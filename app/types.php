<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class types extends Model
{
    protected $table = 'types';
    protected $fillable= ['id','description'];
}
