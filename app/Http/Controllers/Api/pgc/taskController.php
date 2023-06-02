<?php

namespace App\Http\Controllers\Api\pgc;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Users\User\UserRequest;

use App\Models\Applicant;
use App\Models\SubmissionLog;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;
use Validator;

use App\Models\Users\UserAccess;

use App\Models\Users\User;
use App\Models\System\Log;
use App\Models\BuildType;
use App\Models\BuildDesc;
use App\Models\Submission;
use App\Models\DashMap;
use App\Models\Owner;
use App\Models\Includes;
use App\Models\Task;



use App\Exports\exportIncludes;
use App\Exports\SubExport;




use function Symfony\Component\VarDumper\Dumper\esc;


class taskController extends Controller
{
    public function lookUps()
    {
        $data = (object)[];
        $query = Submission::where('task_status', 0)->select('id','building_number')->get();
        $data->submission_id = $query;
        
        $surveyRole = Role::where('name', 'Surveyor')->first();
        $surveyUsers = User::whereHas('roles', function ($query) use ($surveyRole) {
            $query->where('role_id', $surveyRole->id);
        })->select('name_local','id')->get();
        $data->survey_users = $surveyUsers;
        
        return \response(['data'=>$data]);
    }

    public function save_task(Request $request,Task $task)
    {
        // return $request;
        if (!$task) {
            $task = new Task();
        }
        
        $task->fill($request->all());
        $task->admin_id = Auth::user()->id;
        $task->save();
        return response($task);
    }
}
