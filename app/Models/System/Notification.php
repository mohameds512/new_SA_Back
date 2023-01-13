<?php

namespace App\Models\System;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use App\Models\System\System;
use App\Models\Users\User;

class Notification extends Model {

    const TYPE_SYSTEM = 1;
    const TYPE_POSTGRADUATE = 2;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'seen',
        'data'
    ];

    protected $casts = ['data' => 'json'];

	public function user() {

        return $this->belongsTo(User::class);
    }

	public function createdAt() {

        return ($this->created_at) ? Carbon::parse($this->created_at) : null;
    }

    public function data($details = System::DATA_BRIEF) {

		$data = (object) [];

        $data->id = $this->id;
        $data->user = $this->user->data();
        $data->type = $this->type;
        $data->title = $this->title;
        $data->message = $this->message;
        $data->seen = $this->seen;
        $data->created_at = formatDateTime($this->createdAt());

        if($details >= System::DATA_DETAILS) {

            $data->data = $this->data;
            $data->removed = $this->removed;
        }
        
        return $data;
	}

    public function remove() {

        $this->removed = 1;
        $this->save();
        
        return true;
    }

    public function restore() {

        $this->removed = 0;
        $this->save();

        return true;
    }

    public static function test() {

        if(!Notification::first()) {
            
            $notification = new Notification();
            $user = User::first();
            $notification->fill([
                'user_id' => $user->id,
                'type' => Notification::TYPE_SYSTEM,
                'title' => 'test',
                'message' => 'test message',
                'data' => $user->getAttributes(),
            ]);
            $notification->save();
        }

        $notification = Notification::first();

        d(["Notification" => $notification->data()]);
        d(["Notification List" => $notification->data(System::DATA_LIST)]);
        d(["Notification Details" => $notification->data(System::DATA_DETAILS)]);

        dd("done");
    }
}
