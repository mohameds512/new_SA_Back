<?php

namespace App\Models\Users;

use App\Models\Archive\Archive;
use App\Models\Chats\Chat;
use App\Models\Proctors\Proctor;
use App\Models\Proctors\proctorNote;
use App\Models\Proctors\ProctorPreference;
use App\Models\Programs\FacultyUser;
use App\Models\Programs\ProgramUser;
use App\Models\System\log;
use App\Models\System\Notification;
use App\Models\System\System;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use DB;
use Matrix\Exception;
use PHPMailer\PHPMailer;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

//after changing files:
//composer dump-autoload
//php artisan passport:install --force


class User extends Authenticatable
{
    // use HasRoles;

    const TYPE_INSTRUCTOR = 1;
    const TYPE_EMPLOYEE = 2;
    const TYPE_STUDENT = 3;
    const TYPE_APPLICANT = 4;
    const TYPE_GUEST = 100;
    const TYPE_OTHER = 200;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    public static function types()
    {

        return [
            User::TYPE_INSTRUCTOR,
            User::TYPE_EMPLOYEE,
            User::TYPE_STUDENT,
            User::TYPE_APPLICANT,
            User::TYPE_GUEST,
            User::TYPE_OTHER
        ];
    }

    use HasApiTokens, Notifiable, HasRoles;

//    protected  $guarded = [];

    protected $fillable = [
        'email',
        'type',
        'national_id',
        'birth_date',
        'personal_email',
        'mobile',
        'phone',
        'password',
        'name',
        'name_local',
        'first_name',
        'middle_name',
        'last_name',
        'nationality_id',
        'gender',
        'address',
        'postal_code',
        'full_name',
        'full_name_local',
        'passport_number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


//    public function devices()
//    {
//
//        return $this->hasMany(Device::class);
//    }


    public function notifications()
    {

        return $this->hasMany(Notification::class);
    }

    public function chats()
    {

        return $this->hasMany(Chat::class);
    }


    public function logs()
    {

        return $this->hasMany(Log::class);
    }


    public function birthDate()
    {

        return ($this->birth_date) ? Carbon::parse($this->birth_date) : null;
    }

    public function data($details = System::DATA_BRIEF)
    {

        $data = (object)[];

        $data->id = $this->id;
        $data->code = $this->code;
        $data->name = $this->name;
        $data->name_local = $this->name_local;
        $data->removed = $this->removed;
        if ($details >= System::DATA_LIST) {

            $data->mobile = $this->mobile;
            $data->email = $this->email;

        }

        if ($details >= System::DATA_DETAILS) {
            $data->mobile = $this->mobile;
            $data->type = self::TYPE_EMPLOYEE;
            $data->gender = self::genderOf($this->gender);
            $data->phone = $this->phone;
            $data->removed = $this->removed;


        }

        return $data;
    }

    public static function createPassword($data)
    {

        $user = self::locate($data->email, $data->mobile);

        if (!$user->password) {

            $user->password = bcrypt("Ems@2022");
            $user->save();
        }
    }

    public static function adminLogin($email)
    {

        $user = self::whereEmail($email)->first();

        if ($user) {

            Auth::login($user);
            return true;
        }

        return false;
    }

    public static function decodeType($type)
    {

        if ($type == self::TYPE_INSTRUCTOR) {
            return (object)['name' => 'Instructor', 'name_local' => 'محاضر', 'type' => self::TYPE_INSTRUCTOR];
        } elseif ($type == self::TYPE_EMPLOYEE) {
            return (object)['name' => 'Employee', 'name_local' => 'موظف', 'type' => self::TYPE_EMPLOYEE];
        } elseif ($type == self::TYPE_STUDENT) {
            return (object)['name' => 'Student', 'name_local' => 'طالب', 'type' => self::TYPE_STUDENT];
        } elseif ($type == self::TYPE_APPLICANT) {
            return (object)['name' => 'Applicant', 'name_local' => 'متقدم', 'type' => self::TYPE_APPLICANT];
        } elseif ($type == self::TYPE_GUEST) {
            return (object)['name' => 'Guest', 'name_local' => 'زائر', 'type' => self::TYPE_GUEST];
        } else {
            return (object)['name' => 'Other', 'name_local' => 'اخرى', 'type' => self::TYPE_OTHER];
        }
    }

    public function isExternalEmail()
    {
        // return (strpos($this->email, env('SYSTEM_DOMAIN')) === false);
    }


    //not used now


    public static function genderOf($gender)
    {

        if ($gender == self::GENDER_MALE) {
            return 'male';
        } elseif ($gender == self::GENDER_FEMALE) {
            return 'female';
        }
    }


    public static function locate($email, $mobile)
    {

        if (empty($email) && empty($mobile)) return null;

        return User::where(function ($query) use ($email, $mobile) {

            if ($email) $query->orWhere('email', $email);
            if ($mobile) $query->orWhere('mobile', $mobile);
        })->first();
    }

    public function save(array $options = [])
    {

        $text = getFTS("$this->first_name $this->second_name $this->third_name $this->last_name $this->name $this->name_local $this->address");
        $this->search_text = "#$this->id, #$this->code, #$this->national_id, $text, $this->email, $this->personal_email, $this->mobile";

        parent::save($options);
    }

    public function remove()
    {

        $this->removed = 1;
        $this->save();

        return true;
    }

    public function restore()
    {

        $this->removed = 0;
        $this->save();
        return true;
    }

}
