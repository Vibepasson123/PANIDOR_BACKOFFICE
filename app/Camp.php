<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
  protected $table = 'campaign';



  protected $fillable = [
    'name',
    'discription',
    'product_id',
    'quality',
    'price',

  ];



  public function campp()
  {

    return  $this->hasMany(Mpos::class);
  }
  
  public function camppos()
  {
    return $this->hasMany(MposCamp::class);
  }

  public function camp_mpos()
  {
    return $this->hasMany(MposCamp::class);
  }

  public function camp_status()

  {

    return $this->hasMany(MposCamp::class);
  }
}
