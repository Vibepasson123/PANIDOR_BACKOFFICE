<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table='product';

    protected $fillable=['discription',
    'name','codArtigo','vatid',
    
];

   public function salepro()
   {
    
    return $this->hasMany(mposSale::class);

   }


public function productmpos()
{
    return $this->belongsToMany(Mpos::class,'product_mpos');
}


   public function campaign_Product()
   {
       return $this->hasMany(MposCamp::class);
   }

   public function orderprodcut()
   {
       return $this->hasMany(order::class);
   }
   public function OrderDel()
   {
       return $this->hasOne(orderDetails::class);
   }




}
