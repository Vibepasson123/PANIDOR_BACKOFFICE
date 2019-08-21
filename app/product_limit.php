<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_limit extends Model
{
    protected $table = 'product_limit';

    protected  $fillable =['id','mpos_id','product_id','limit_time','limit','created_at','updated_at'];




   public function limitProduct()
   {
       return $this->belongsToMany(product::class);
   }
   public function limitMpos()
   {
       return $this->belongsToMany(Mpos::class);
   }
   

}
