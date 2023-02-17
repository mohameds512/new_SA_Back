<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{

    protected $guarded = ['id'];
    protected $table = 'applicants';
}
