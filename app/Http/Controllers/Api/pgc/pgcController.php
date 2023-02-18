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

use App\Models\BuildType;
use App\Models\BuildDesc;
use App\Models\Submission;
use App\Models\DashMap;
use App\Models\Owner;
use App\Models\Includes;
use function Symfony\Component\VarDumper\Dumper\esc;


class pgcController extends Controller
{


    public function lookups()
    {

        $includes = BuildType::select('id', 'name')->with('BuildDesc')->get();

        return \response(['includes_type' => $includes,]);
    }

    public function edit_desc(Request $request, BuildDesc $desc = null)
    {
        // return $request;
//        $desc = BuildDesc::where('id', $request->desc_id)->first();
        if (!$desc) {
            $desc = new BuildDesc();
            $desc->building_type_id = $request->type;
            $desc->name = $request->desc_name;
        }
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
        $user_id = Auth::user()->id;

        if ($request->has('submission_number') && strlen($request->submission_number) > 0) {
            $sub = new Submission();
            
            $sub->building_number = $request->submission_number;
        } else {

            $sub = Submission::find($request->submission_id);
        }
        $sub->created_by = $user_id;
        $merged_submissions = $request->merged_submissions && strlen($request->merged_submissions) > 0 ? explode(',', $request->merged_submissions) : null;
        $isolate_submissions = $request->isolate_submissions && strlen($request->isolate_submissions) > 0 ? explode(',', $request->isolate_submissions) : null;
        $sub->operation_type = $request->operation_type;
        $sub->isolate_submissions = $isolate_submissions;
        $sub->merged_submissions = $merged_submissions;


        Submission::whereIn('building_number', $merged_submissions)->update(['status' => SubmissionLog::MARGE]);

        if ($request->file('before_file')) {
            $before_file = $request->file('before_file');
            $before = Str::random(7);
            $before_name = "before_$before";
            saveRequestFile($before_file, "$before_name", "submissions/$sub->id");
            $sub->before_image = $before_name;
        }


        if ($request->file('after_file')) {
            $after_file = $request->file('after_file');
            $after = Str::random(7);
            $after_name = "before_$after";
            saveRequestFile($after_file, "$after_name", "submissions/$sub->id");
            $sub->after_image = $after_name;
        }


        $sub->save();


        SubmissionLog::log($sub, SubmissionLog::IN_REVIEW);
        return response(['submission' => $sub], 201);

    }

    public function dashboard(Request $request)
    {

        $statistics = DB::table('submissions')->select(DB::raw('COUNT(status) as count'), 'status')->where('status', '!=', 4)
            ->groupBy('status')->get();
        $map = DashMap::latest()->first();
        $dashboard_img = route("dashboard_map", ["img" => $map->name, "no_cache" => Str::random(3)]);
        // $statistics["img"] = $dashboard_img;
        // []
        return success(["statistics" => $statistics, "img" => $dashboard_img]);
    }

    public function get_incs(Request $request)
    {
        $incs = Includes::where('submission_id', $request->id)
            ->select('includes.*', 'building_types.name as type', 'building_type_contents.name as content', 'building_type_contents.unit as unit')
            ->join('building_types', 'building_types.id', 'includes.build_id')
            ->join('building_type_contents', 'building_type_contents.id', 'includes.build_desc_id');
        $includes = $incs->get()->transform(function ($item) {

            if ($item->image) {
                $item->image = route('includes_image', ['submission_id' => $item->submission_id, 'img' => $item->image, 'no_cache' => Str::random(4)]);
            }

            return $item;

        });

        return \response(['includes' => $includes]);
    }


    public function show(Request $request, Submission $submission)
    {
        return success($submission);

    }

    public function show_sub(Request $request, Submission $submission)
    {
        $data = (object)[];

        $sub = Submission::where('id', $request->id)->with('includes')->first();

        $sub->building_details = $sub->building_details;
        $sub->contract_border_details = $sub->contract_border_details;
        $sub->restrict_border = $sub->restrict_border;
        $sub->coordinates = $sub->coordinates;
        $sub->isolate_submissions = $sub->isolate_submissions;
        $sub->merged_submissions = $sub->merged_submissions;

        $sub->includes_data = $sub->includes()
            ->select('includes.qty', 'includes.id as inc_id', 'building_types.name as type', 'building_type_contents.name as content',
                'includes.image', 'includes.submission_id', 'includes.floors', 'includes.notes', 'building_type_contents.unit as unit',
                'building_type_contents.price as price')
            ->join('building_types', 'building_types.id', 'includes.build_id')
            ->join('building_type_contents', 'building_type_contents.id', 'includes.build_desc_id')
            ->get()->transform(function ($item) {

                if ($item->image) {
                    $item->image = route('includes_image', ['submission_id' => $item->submission_id, 'img' => $item->image, 'no_cache' => Str::random(4)]);
                }

                return $item;

            });;

        if ($sub->before_image) {
            $sub->before_image = route('image', ['submission_id' => $request->id, 'img' => $sub->before_image, 'no_cache' => Str::random(4)]);
        }

        if ($sub->after_image) {
            $sub->after_image = route('image', ['submission_id' => $request->id, 'img' => $sub->after_image, 'no_cache' => Str::random(4)]);
        }

        if ($sub->signature_eng == 1) {
            $sub->signature_eng = route('image', ['submission_id' => $request->id, 'img' => "signature-1", 'no_cache' => Str::random(4)]);
        }

        if ($sub->signature_owner == 1) {
            $sub->signature_owner = route('image', ['submission_id' => $request->id, 'img' => "signature-2", 'no_cache' => Str::random(4)]);
        }

        if ($sub->signature_poss == 1) {
            $sub->signature_poss = route('image', ['submission_id' => $request->id, 'img' => "signature-3", 'no_cache' => Str::random(4)]);
        }

        if ($sub->signature_vice == 1) {
            $sub->signature_vice = route('image', ['submission_id' => $request->id, 'img' => "signature-4", 'no_cache' => Str::random(4)]);
        }

        if ($sub->map) {
            $sub->map = route('image', ['submission_id' => $request->id, 'img' => $sub->map, 'no_cache' => Str::random(4)]);
        }


        $logs_data = [];

        foreach ($sub->logs as $log) {
            $logs_data[] = $log->data();
        }

        $sub->logs_data = $logs_data;

        $data->submission[] = $sub;

        $owners = Owner::where('submission_id', $request->id);
        $data->owners = $owners->get()->toArray();

        $applicants = Applicant::where('submission_id', $request->id);
        $data->applicants = $applicants->get()->toArray();

        return \response([
            'data' => $data
        ]);

    }

    public function saveSignature(Request $request, Submission $submission)
    {

        if ($request->type == 1) {
            $submission->signature_eng = 1;
        }

        if ($request->type == 2) {
            $submission->signature_owner = 1;
        }

        if ($request->type == 3) {
            $submission->signature_poss = 1;
        }

        if ($request->type == 4) {
            $submission->signature_vice = 1;
        }

        $submission->save();

        self::addSignatureFile($request->signature, "submissions/$submission->id/signature-$request->type.png");
        return success(true);
    }

    public function dashMapImage(Request $request, $img, $no_cache)
    {


        $paths = findFiles("dashMaps", "$img");

        if (isset($paths[0]) && $paths[0]) {
            return responseFile($paths[0], "$img");
            // return response()->download($paths[0]);
        }
        return response(['message' => 'not found'], 404);

    }

    public function submissionImages(Request $request, $submission_id, $img, $no_cache)
    {


        $paths = findFiles("submissions/$submission_id", "$img");

        if (isset($paths[0]) && $paths[0]) {
            return responseFile($paths[0], "$img");
            // return response()->download($paths[0]);
        }
        return response(['message' => 'not found'], 404);

    }

    public function submissionIncludesImages(Request $request, $submission_id, $img, $no_cache)
    {


        $paths = findFiles("submissions/$submission_id/includes", "$img");

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
        $subs = Submission::select('submissions.*','users.name_local')->leftJoin('users','users.id','submissions.created_by')
        ->where('status', '!=', SubmissionLog::MARGE)->get();
        return \response([
            'submissions' => $subs
        ]);
    }

    public function update_dash_map(Request $request)
    {

        $map = $request->file('dash_map');
        $fileName = Str::random(7);
        $mapName = "map_$fileName";
        saveRequestFile($map, "$mapName", "dashMaps");
        $dashMap = new DashMap();
        $dashMap->name = $mapName;
        $dashMap->save();
        return success($dashMap);
    }


    public function storeMap(Request $request, Submission $submission)
    {
        $map = $request->file('submission_map');
        $fileName = Str::random(7);
        $mapName = "map_$fileName";
        saveRequestFile($map, "$mapName", "submissions/$submission->id");
        $submission->map = $mapName;
        $submission->save();
        return success($submission);
    }

    public function delete_inc(Request $request)
    {
        $id = $request[0];
        $inc = Includes::find($id);
        $inc->delete();
        return success(true);
    }

    public function save_includes(Request $request, Includes $includes = null)
    {
        $names = explode(",", $request->floors_name);
        $area = explode(",", $request->floors_area);
        $length = count($names);
        $floors = array();

        foreach ($names as $key => $value) {
            array_push($floors, array('floor' => $names[$key], 'area' => $area[$key]));
        }

        // return  $floors;
        if (!$includes) {
            $includes = new Includes();
        }

        $img = $request->file('image');
        $fileName = Str::random(7);
        $imgName = "$fileName";
        saveRequestFile($img, "$imgName", "submissions/$request->submission_id/includes");
        $includes->image = $imgName;
        $includes->build_id = $request->build_id;
        $includes->build_desc_id = $request->build_desc_id;
        $includes->qty = $request->qty;
        $includes->notes = $request->notes;
        $includes->submission_id = $request->submission_id;
        $includes->floors = $floors;
        $includes->save();

        return response(['includes' => $includes], 201);
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

    public function save_submission(Request $request, Submission $sub)
    {

        $user_id = Auth::user()->id;
        // $user_name = User::where('id', $user_id)->get('name_local');

//        $build_num = Str::random(7);
        $sub_data = $request->submission;
        $sub->fill($sub_data);
        $sub->created_by = $user_id;
        $sub->save();

        foreach ($request->owners as $owner) {
            $newOwner = Owner::whereSubmissionIdAndNationalId($sub->id, $owner['national_id'])->first();
            if (!$newOwner) {
                $newOwner = new Owner();
            }
            $newOwner->fill($owner);
            $newOwner->submission_id = $sub->id;
            $newOwner->save();
        }

        foreach ($request->applicants as $applicant) {
            $newApplicant = Applicant::whereSubmissionIdAndNationalId($sub->id, $applicant['national_id'])->first();
            if (!$newApplicant) {
                $newApplicant = new Applicant();
            }
            $newApplicant->fill($applicant);
            $newApplicant->submission_id = $sub->id;
            $newApplicant->save();
        }

        return response($sub);
    }

    public function changeStatus(Request $request, Submission $submission)
    {
        return SubmissionLog::log($submission, $request->status, $request->note);
    }


}
