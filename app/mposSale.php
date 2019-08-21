<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mposSale extends Model
{
     protected $table ='MPOS_SALE';


      protected $filabale=[
                             
      ' product_id',
      'quntity',
      'mpos_id',
      'og_invoice_id',
      'code_Artigo',
      'price',

      ];

   public function getpro()
   {
       return $this->belongsToMany(product::class);
   }
   
}
