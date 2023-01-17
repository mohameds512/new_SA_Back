<?php

namespace App\Models\System;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use App\Models\System\System;
use App\Models\Users\User;

class Log extends Model {

    protected $casts = ['old_value' => 'json', 'new_value' => 'json', 'request' => 'json'];

    public function user() {

        return $this->belongsTo(User::class);
    }

	public static function log($action, $model, $oldValue = null) {

        $log = new Log();
        $log->user_id = auth()->id();
        $log->action = $action;
        if(is_string($model)) {
            $log->model = $model;
            $log->model_id = 0;
        }
        else {
            $log->model = get_class($model);
            $log->model_id = $model->id;
        }
        $log->url = request()->path();
        $log->old_value = $oldValue;
        $log->new_value = $model->getAttributes();
        $log->request = request()->all();

        if($log->user_id===null && str_ends_with($log->model, "\User")) {
            $log->user_id = $log->model_id;
        }
        else if($log->user_id===null && $log->model=="Server\Error") {
            $user = User::where('email', 'admin@auston.com')->first();
            if(empty($user)) return null;
            $log->user_id = $user->id;
        }

        $log->save();

        return $log->id;
    }

    public function createdAt() {

        return ($this->created_at) ? Carbon::parse($this->created_at) : null;
    }

    public function data($details = System::DATA_BRIEF) {

        $data = (object) [];

        $data->id = $this->id;
        $data->user = ($this->user)? $this->user->data(null) : null;
        $data->action = $this->action;
        $data->created_at = formatDateTime($this->createdAt());

        if($details >= System::DATA_DETAILS) {

            $data->model = $this->model;
            $data->model_id = $this->model_id;
            $data->url = $this->url;
            $data->old_value = $this->old_value;
            $data->new_value = $this->new_value;
            $data->request = $this->request;
        }

        return $data;
    }

    public static function removeModelLogs($model) {

        Log::where('model', get_class($model))->where('model_id', $model->id)->delete();
    }

    public static function test() {

        if(!Log::first()) Log::log('user/log', User::first());

        $log = Log::first();

        d(["Log" => $log->data()]);
        d(["Log List" => $log->data(System::DATA_LIST)]);
        d(["Log Details" => $log->data(System::DATA_DETAILS)]);

        dd("done");
    }
}
