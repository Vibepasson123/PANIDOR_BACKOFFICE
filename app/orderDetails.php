<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderDetails extends Model
{
    protected $table = 'orderLines';

    protected $fillable = ['product_id','price','vatid','quntity','order_id'];







    public function OrderDel()
    {
        return $this->belongsToMany(product::class);
    }


}
