<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activation extends Model
{
    protected $table ='activations';
    protected $fillable=[ 'user_id','id',
    'completed',
    'completed_at',
    
 ];
}
