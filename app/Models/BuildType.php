<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BuildDesc;

class BuildType extends Model
{
    protected $guarded = [];
    protected $table = 'building_types';

    public function BuildDesc ( )
    {
        return $this->hasMany(BuildDesc::class, 'building_type_id');
    }
}
