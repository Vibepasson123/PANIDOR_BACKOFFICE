<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    protected $table= "role_users";
    




    public function user_role()
    {
     
         return $this->belongsToMany(User::class);
    }
}
