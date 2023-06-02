<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
     protected $table = 'permissions';

    protected $guarded=[];

    public function usersAccess()
    {
        return $this->belongsToMany(UserAccess::class, 'users_access_permissions');
    }
}
