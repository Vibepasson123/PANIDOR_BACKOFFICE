<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    protected $table = 'voucher';


    protected $fillable=[ 'client_id',
    'voucherPoint',
    'voucher',
   
    
 ];




 public function clientVoucher()

 {
   
    return  $this->hasMany(clientUser::class);
    
 }

}
