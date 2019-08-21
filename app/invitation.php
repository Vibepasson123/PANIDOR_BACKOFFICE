<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
   
    protected $table='invitation';
    protected $fillable=[ 'clientUser_id',
    'invitataion_num',
    'id',
    
  
 ];  

  
}
