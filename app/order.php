<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table='order';

    protected $fillable= ['clientUser_id','product_id','quantity','pickupTime','mpos_id','og_order_id'];





    public function orderDetails()
    {
    
        return  $this->belongsToMany(product::class) ;
    
    
    }

}


