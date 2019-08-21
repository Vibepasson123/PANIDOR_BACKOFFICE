<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class og_client extends Model
{
    protected $table = 'MPOS_clientuser';

    protected $fillable = [
        
         ' mpos_id',
          'client_id',
          'og_client_id'
    
    ];

}
