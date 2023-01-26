<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $guarded = [];
    protected $table = 'submissions';

    const IN_REVIEW = 0;
    const FEEDBACK = 1;
    const APPROVED = 2;
    const OWNER_APPROVED = 3;

    protected $costs = ['building_details'=>'json','contract_border_details'=>'JSON','restrict_border'=>'json','coordinates'=>'json'];

    public function building_types()
    {
        return $this->belongsToMany(BuildType::class, 'includes', 'submission_id' , 'build_id');

    }
    public function includes ()
    {
        return $this->hasMany(Includes::class, 'submission_id');

    }

    public function logs(){
        return $this->hasMany(SubmissionLog::class, 'submission_id');
    }
    // public function owners ()
    // {
    //     return $this->hasMany(Includes::class, 'submission_id');

    // }
}
