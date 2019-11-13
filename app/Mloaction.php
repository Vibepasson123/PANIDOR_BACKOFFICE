<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mloaction extends Model
{
    protected $table = 'MPOS_LOCATION';
    protected $fillable = [
        'postalcode',
        'longitude',
        'latitude',
        'mpose_id',
        'date_time',
        'streetname',

    ];



    public function relMpos()
    {

        return $this->belongTo(Mpos::class);
    }
}
