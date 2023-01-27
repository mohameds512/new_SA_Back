<?php

namespace App\Http\Controllers\Api\pgc;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Users\User\UserRequest;

use App\Models\SubmissionLog;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Validator;

use App\Models\System\Device;
use App\Models\System\Log;
use App\Models\System\Paginator;
use App\Models\System\System;
use App\Models\System\SystemMail;
use App\Models\Users\User;
use App\Models\Users\UserAccess;


use App\Models\BuildType;
use App\Models\BuildDesc;
use App\Models\Submission;
use App\Models\Owner;
use App\Models\Includes;


class pgcController extends Controller
{
    public function lookups()
    {

        $includes = BuildType::select('id', 'name')->with('BuildDesc')->get();

        return \response([
            'includes_type' => $includes,
        ]);
    }
<<<<<<< HEAD

=======
    public function edit_desc(Request $request)
    {
        // return $request;
        $desc = BuildDesc::where('id',$request->desc_id)->first();
        $desc->price = $request->desc_price;
        $desc->unit = $request->desc_unit;
        $desc->save();
        return \response(['done',200]);
    }
    public function get_build_desc( )
    {
        $build_desc = BuildDesc::select('building_type_contents.id as desc_id','building_type_contents.name as desc_name',
                            'building_type_contents.unit as desc_unit','building_type_contents.price as desc_price',
                            'building_types.name as type_name' , 'building_types.id as type_id')
                        ->join('building_types','building_types.id','building_type_contents.building_type_id')
                        ->get();
        return \response(['build_desc'=> $build_desc]);
    }
>>>>>>> 9555387ca958d1aa0b3da7a90a65ac87e6ae7263
    public function save_floor(Request $request)
    {
        return $request;
    }
<<<<<<< HEAD

    public function show_sub(Request $request, Submission $submission)
=======
    public function get_incs(Request $request )
    {
        $incs = Includes::where('submission_id',$request->id)
                ->select('includes.*','building_types.name as type', 'building_type_contents.name as content')
                ->join('building_types', 'building_types.id' , 'includes.build_id')
                ->join('building_type_contents', 'building_type_contents.id' , 'includes.build_desc_id');
        $includes = $incs->get();
        return \response(['includes'=> $includes]) ;
    }
    public function show_sub( Request $request, Submission $submission)
>>>>>>> 9555387ca958d1aa0b3da7a90a65ac87e6ae7263
    {
        $data = (object)[];

        $sub = Submission::where('id', $request->id)->with('includes')->first();
        $sub->building_details = json_decode($sub->building_details);
        $sub->contract_border_details = json_decode($sub->contract_border_details);
        $sub->restrict_border = json_decode($sub->restrict_border);
        $sub->coordinates = json_decode($sub->coordinates);
        $sub->includes_data = $sub->includes()
            ->select('includes.qty', 'includes.id as inc_id', 'building_types.name as type', 'building_type_contents.name as content')
            ->join('building_types', 'building_types.id', 'includes.build_id')
            ->join('building_type_contents', 'building_type_contents.id', 'includes.build_desc_id')
            ->get();

        $logs_data = [];

        foreach ($sub->logs as $log) {
            $logs_data[] = $log->data();
        }

        $sub->logs_data = $logs_data;

        $data->submission[] = $sub;

<<<<<<< HEAD

=======
>>>>>>> 9555387ca958d1aa0b3da7a90a65ac87e6ae7263
        $owners = Owner::where('submission_id', $request->id);
        $data->owners = $owners->get()->toArray();

        return \response([
            'data' => $data
        ]);

    }

    public function getSub()
    {
        $subs = Submission::get();
        return \response([
            'submissions' => $subs
        ]);
    }

    function save_img($file, $name, $folder)
    {
        $title = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->putFileAs($folder, $file, "$name.$extension");
        return "$title.$extension";
    }

<<<<<<< HEAD
    public function save_includes(Request $request, Includes $inc = null)
=======
    
    public function save_includes (Request $request , Includes $includes = null)
>>>>>>> 9555387ca958d1aa0b3da7a90a65ac87e6ae7263
    {
        
        if (!$includes) {
            $includes = new Includes();
        }

        $data = $request->all();
        $includes->fill($data);
        $includes->save();
        
        return response(['includes'=>$includes], 201);

<<<<<<< HEAD
        if ($request->hasfile('project_plan_img')) {

            $img = $request->file('project_plan_img');

            $filename = Str::random(10);
            $imgName = $filename . '.png';
            $this->save_img($img, "$imgName", "includes");

        }
=======
        // if ($request->hasfile('project_plan_img')) {
            
        //     $img = $request->file('project_plan_img');
            
        //     $filename = Str::random(10);
        //     $imgName = $filename.'.png';
        //     $this->save_img($img ,"$imgName","includes");
            
        // }

        
>>>>>>> 9555387ca958d1aa0b3da7a90a65ac87e6ae7263

    }

<<<<<<< HEAD
        $inc->fill($request->all());
        $inc->save();

        $sub_incs = Includes::where('submission_id', $inc->submission_id);
        return response(['includes' => $sub_incs], 201);
=======
    public function approve_sub(Request $request, Submission $sub = null)
    {
        $id = $request->id;
        $submission = Submission::find($id);
        $submission->status = 2;
        $submission->save();
        return $submission;
    }
    public function add_notes(Request $request , Submission $sub = null)
    {
        $id = $request->id;
        $submission = Submission::find($id);
        
        $submission->notes = $request->note;
        $submission->status = 1;
        $submission->save();
        return $submission;
    }
    public function forced_area(Request $request , Submission $sub = null)
    {
        $id = $request->sub_id;
        $submission = Submission::find($id);
        
        $submission->removed_from_unbuilding = $request->removed_from_unbuilding;
        $submission->removed_from_building = $request->removed_from_building;
        
        $submission->save();
        return $submission;
>>>>>>> 9555387ca958d1aa0b3da7a90a65ac87e6ae7263
    }

    public function add(Request $request)
    {

        $sub = new Submission();
        $sub->fill($request->all());
        $sub->save();
        SubmissionLog::log($sub, SubmissionLog::IN_REVIEW);
        return response(['submission' => $sub], 201);

    }

    public function save_submission(Request $request, Submission $sub = null)
    {
        // return response(\json_encode($request->submission['restrict_border'])) ;
        $build_num = Str::random(7);

        if (!$sub) {
            $sub = new Submission();
            $sub_data = $request->submission;
            $sub_data['building_number'] = $build_num;
        }

        $sub_data['building_details'] = $request->building_details;

        $sub_data['restrict_border'] = json_encode($request->submission['restrict_border']);
        $sub_data['building_details'] = json_encode($request->submission['building_details']);
        $sub_data['contract_border_details'] = json_encode($request->submission['contract_border_details']);
        $sub_data['coordinates'] = json_encode($request->submission['coordinates']);

        $sub->fill($sub_data);
        $sub->save();

        foreach ($request->owners as $owner) {
            $newOwner = new Owner();
            $newOwner->fill($owner);
            $newOwner->submission_id = $sub->id;
            $newOwner->save();
        }

        SubmissionLog::log($sub, SubmissionLog::IN_REVIEW);

        return response($sub);
    }

    public function changeStatus(Request $request, Submission $submission)
    {
        return SubmissionLog::log($submission, $request->status, $request->note);
    }


}
