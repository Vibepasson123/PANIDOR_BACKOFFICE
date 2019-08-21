<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MposCamp extends Model
{
    protected $table= 'camp_mpos';

    protected $fillable= ['mpos_id','camp_id','ogCampaign_product_id','start_date','end_date'];



    public function productCampaing()
    {
     return $this-> belongsToMany(product::class);

    }

    public function link_camp()
    {

        return  $this->belongsToMany(Camp::class) ;


    }
    
}

