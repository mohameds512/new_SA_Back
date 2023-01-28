<?php

namespace App\Http\Controllers\Api\pgc;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Users\User\UserRequest;

use App\Models\SubmissionLog;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;
use Validator;

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

    public function edit_desc(Request $request)
    {
        // return $request;
        $desc = BuildDesc::where('id', $request->desc_id)->first();
        $desc->price = $request->desc_price;
        $desc->unit = $request->desc_unit;
        $desc->save();
        return \response(['done', 200]);
    }

    public function get_build_desc()
    {
        $build_desc = BuildDesc::select('building_type_contents.id as desc_id', 'building_type_contents.name as desc_name',
            'building_type_contents.unit as desc_unit', 'building_type_contents.price as desc_price',
            'building_types.name as type_name', 'building_types.id as type_id')
            ->join('building_types', 'building_types.id', 'building_type_contents.building_type_id')
            ->get();
        return \response(['build_desc' => $build_desc]);
    }

    public function add(Request $request)
    {

        $sub = new Submission();
        $sub->fill($request->all());
        $sub->save();
        SubmissionLog::log($sub, SubmissionLog::IN_REVIEW);
        return response(['submission' => $sub], 201);

    }

    public function save_floor(Request $request)
    {
        return $request;
    }

    public function get_incs(Request $request)
    {
        $incs = Includes::where('submission_id', $request->id)
            ->select('includes.*', 'building_types.name as type', 'building_type_contents.name as content')
            ->join('building_types', 'building_types.id', 'includes.build_id')
            ->join('building_type_contents', 'building_type_contents.id', 'includes.build_desc_id');
        $includes = $incs->get();
        return \response(['includes' => $includes]);
    }

    

    public function show_sub(Request $request, Submission $submission)
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

        $sub->signature_eng = route('image', ['submission_id' =>  $request->id , 'img' => "signature-1" , 'no_cache' => Str::random(4)]);
        $sub->signature_owner = route('image', ['submission_id' =>  $request->id , 'img' => "signature-2" , 'no_cache' => Str::random(4)]);
        $sub->signature_poss = route('image', ['submission_id' =>  $request->id , 'img' => "signature-3" , 'no_cache' => Str::random(4)]);

        $logs_data = [];

        foreach ($sub->logs as $log) {
            $logs_data[] = $log->data();
        }

        $sub->logs_data = $logs_data;

        $data->submission[] = $sub;

        $owners = Owner::where('submission_id', $request->id);
        $data->owners = $owners->get()->toArray();

        return \response([
            'data' => $data
        ]);

    }

    public function saveSignature(Request $request, Submission $submission)
    {

        self::addSignatureFile($request->signature, "submissions/$submission->id/signature-$request->type.png");
        return success(true);
    }

    public function submissionImages(Request $request, $submission_id ,  $img , $no_cache)
    {



        $paths = findFiles("submissions/$submission_id", "$img");

        if (isset($paths[0]) && $paths[0]) {
            return responseFile($paths[0], "$img");
            // return response()->download($paths[0]);
        }
        return response(['message' => 'not found'], 404);

    }

    public static function addSignatureFile($signature, $path)
    {

        $img = substr($signature, strpos($signature, ",") + 1);
        $data = base64_decode($img);
        Storage::disk('local')->put($path, $data);
        return $path;
    }

    public function getSub()
    {
        $subs = Submission::get();
        return \response([
            'submissions' => $subs
        ]);
    }


//    function saveRequestFile($file, $name, $folder)
//    {
//
//        $title = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
//        $extension = $file->getClientOriginalExtension();
//        Storage::disk('local')->putFileAs($folder, $file, "$name.$extension");
//
//        return "$title.$extension";
//    }

    function saveRequestImg($file, $name, $folder)
    {
        $title = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->putFileAs($folder, $file, "$name.$extension");
        return "$title.$extension";
    }

    public function storeMap(Request $request)
    {
        $id = $request->submission_id;
        $submission = Submission::find($id);
        $map = $request->file('submission_map');
        $fileName = Str::random(7);
        $mapName = $fileName . 'png';
        $this->saveRequestImg($map, "$mapName", "submissions");
        $submission->map = $mapName;
        $submission->save();

        return \response($submission);
    }

    public function save_includes(Request $request, Includes $includes = null)
    {

        if (!$includes) {
            $includes = new Includes();
        }

        $img = $request->file('image');
        $fileName = Str::random(7);
        $imgName = $fileName . 'png';
        $this->saveRequestImg($img, "$imgName", "includes");

        $includes->image = $imgName;
        $includes->build_id = $request->build_id;
        $includes->build_desc_id = $request->build_desc_id;
        $includes->qty = $request->qty;
        $includes->save();

        return response(['includes' => $includes], 201);

        // if ($request->hasfile('project_plan_img')) {

        //     $img = $request->file('project_plan_img');

        //     $filename = Str::random(10);
        //     $imgName = $filename.'.png';
        //     $this->saveRequestImg($img ,"$imgName","includes");

        // }


    }

    public function approve_sub(Request $request, Submission $sub = null)
    {
        $id = $request->id;
        $submission = Submission::find($id);
        $submission->status = 2;
        $submission->save();
        return $submission;
    }

    public function add_notes(Request $request, Submission $sub = null)
    {
        $id = $request->id;
        $submission = Submission::find($id);

        $submission->notes = $request->note;
        $submission->status = 1;
        $submission->save();
        return $submission;
    }

    public function forced_area(Request $request, Submission $sub = null)
    {
        $id = $request->sub_id;
        $submission = Submission::find($id);

        $submission->removed_from_unbuilding = $request->removed_from_unbuilding;
        $submission->removed_from_building = $request->removed_from_building;

        $submission->save();
        return $submission;
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

        // $data= [];
        // foreach ($request->includesForm as $inc) {
        //     $data[$inc['type']] = ['build_desc_id'=> $inc['desc'], 'qty'=> $inc['area']];
        // }

        // $sub->building_types()->sync($data);

        // $includes = $request->includesForm;


        // if ($includes->image) {

        //     $img = $includes->image;
        //     $imgName = time().'_'.$img->getClientOriginalExtension();
        //     $img->move(\public_path('includes'),$img);

        //     $includes->image = $imgName;
        // }

        // $sub->building_types()->sync($includes);


        return response($sub);
    }

    public function changeStatus(Request $request, Submission $submission)
    {
        return SubmissionLog::log($submission, $request->status, $request->note);
    }


}
