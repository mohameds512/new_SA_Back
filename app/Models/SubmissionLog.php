<?php

namespace App\Models;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubmissionLog extends Model
{

    protected $table = 'submission_logs';

    protected $guarded = [];

    const IN_REVIEW = 0;
    const FEEDBACK = 1;
    const APPROVED = 2;
    const OWNER_APPROVED = 3;

    const status = [
        ['status' => self::IN_REVIEW, 'name' => 'تحت المراجعة'],
        ['status' => self::FEEDBACK, 'name' => 'يراجع مرة أخري'],
        ['status' => self::APPROVED, 'name' => 'تم الاعتماد'],
        ['status' => self::IN_REVIEW, 'name' => 'تحت المراجعة']
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function data()
    {

        $data = (object)[];
        $data->status = self::status[$this->status];
        $data->user = $this->user;
        $data->note = $this->note;
        $data->created_at = $this->created_at;

        return $data;

    }

    public static function log($submission, $status, $note = null)
    {
        $log = new SubmissionLog();
        $log->status = $status;
        $log->submission_id = $submission->id;
        $log->note = $note;
        $log->user_id = Auth::user()->id;
        $log->save();
        $submission->status = $status;
        $submission->save();
        return true;
    }
}
