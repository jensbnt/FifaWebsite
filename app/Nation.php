<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    protected $fillable = ['id', 'name', 'nation_img_link'];
}
