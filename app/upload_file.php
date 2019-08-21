<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class upload_file extends Model
{
    protected $table ='image';

    protected $fillable=['id','filename','file_id','image_class','selected'];
    
}
