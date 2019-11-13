<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Mlocation;

class Mpos extends Model
{
  protected $table = 'MPOS';

  protected $fillable = [
    'name', 'id',
    'discription',
    'OGURL',
    'OGapiUser',
    'OGapipass',
    'MPOS_LOCATION_id'
  ];


  public function mloc()

  {
    return $this->hasMany(Mloaction::class);
  }
  public function campp()
  {
    return $this->belongsToMany(Camp::class)->withTimestamps();
  }
  public function productmpos()
  {
    return $this->belongsToMany(product::class, 'product_mpos');
  }

  public function mposRate()
  {

    return $this->hasMany(reviews::class);
  }



  public function mposOrder()
  {

    return $this->hasMany(order::class);
  }
}
