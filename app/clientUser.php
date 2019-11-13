<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientUser extends Model
{
   protected $table= 'clientUser';


   protected $fillable=['email','hash'];

   public function clientVoucher()

   {
     
      return  $this->belongsTo(voucher::class);
      
   }


}
