<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reviews extends Model
{
    protected $table = 'reviews';

    protected $fillable = ['id', 'client_id', 'mpos_id', 'rate', 'comments'];
}
