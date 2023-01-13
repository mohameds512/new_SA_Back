<?php

namespace App\Http\Controllers\Api\pgc;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Users\User\UserRequest;
use App\Models\Grades\GradeTerm;
use App\Models\Programs\Course;
use App\Models\Programs\Faculty;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    public function lookups( )
    {

        $includes = BuildType::select('id','name')->with('BuildDesc')->get();

        return \response([
            'includes_type' => $includes,
        ]);
    }

    public function show_sub( Request $request, Submission $submission)
    {
        $data = (object)[];

        $sub = Submission::where('id',$request->id)->with('includes')->first();
        $sub->building_details = json_decode($sub->building_details);
        $sub->contract_border_details = json_decode($sub->contract_border_details);
        $sub->restrict_border = json_decode($sub->restrict_border);
        $sub->includes_data =  $sub->includes()
            ->select('includes.qty','building_types.name as type', 'building_type_contents.name as content')
            ->join('building_types', 'building_types.id' , 'includes.build_id')
            ->join('building_type_contents', 'building_type_contents.id' , 'includes.build_desc_id')
            ->get();

        $data->submission[] = $sub;




        $owners = Owner::where('submission_id', $request->id);
        $data->owners = $owners->get()->toArray();

        return \response([
            'data'=>$data
        ]);

    }
    public function getSub()
    {
        $subs = Submission::get();
        return \response([
            'submissions' => $subs
        ]);
    }

    public function save_submission( Request $request )
    {
        // return response(\json_encode($request->submission['restrict_border'])) ;

        $sub_data = $request->submission;
        $sub= new Submission();
        $sub_data['building_details'] = $request->building_details;
        $sub_data['restrict_border'] = json_encode($request->submission['restrict_border']);
        $sub_data['building_details'] = json_encode($request->submission['building_details']);
        $sub_data['contract_border_details'] = json_encode($request->submission['contract_border_details']);
        $sub->fill($sub_data);
        $sub->save();

        foreach ($request->owners as $owner) {
            $newOwner = new Owner();
            $newOwner->fill($owner);
            $newOwner->submission_id = $sub->id;
            $newOwner->save();
        }
        // $data= [];
        // foreach ($request->includesForm as $inc) {
        //     $data[$inc['type']] = ['build_desc_id'=> $inc['desc'], 'qty'=> $inc['area']];
        // }

        // $sub->building_types()->sync($data);

        $includes = $request->includesForm;
        $sub->building_types()->sync($includes);


        return response($sub);
        // DB::beginTransaction();

        // try {
        //     $sub= new Submission();

        //     $sub_data = $request->submissions;
        //     $sub->fill($sub_data);
        //     $sub->save();

        //     $owner_data = $request->owners;


        //     $includes_data = $request->includesForm;

        //     DB::commit();
        // } catch (\Exception  $e) {
        //     DB::rollback();
        // }

        // $subs = Submission::get();

        // return response([
        //     'submissions' => $subs
        // ] , 200);
    }


}
