<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Includes extends Model
{
    protected $guarded = [];
    protected $table = 'includes';
    protected $casts = ['floors'=>'json'];
    protected $costs = ['floors'=>'json'];

    
}
