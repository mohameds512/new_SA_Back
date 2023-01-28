<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $guarded = ['id'];
//    protected $hidden = ['id'];
    protected $table = 'owners';

}
