<?php

namespace App\Models\Lookups;

use Illuminate\Database\Eloquent\Model;
use App\Models\System\System;


class Country extends Model
{
    protected $fillable = [
        'name',
        'ios_code',
        'continent'
    ];

    public function save(array $options = [])
    {
        $name = "$this->name";
        $text = "$this->name";
        $ios_code = ($this->ios_code) ? $this->ios_code : "";
        $continent = ($this->continent) ? $this->continent : "";
        $text = "#$this->id, " . getFTS($text) . ", $name,$ios_code,$continent";
        $this->search_text = $text;
        parent::save($options);
    }

    public function data($details = System::DATA_BRIEF)
    {

        $data = (object)[];

        $data->id = $this->id;
        $data->name = $this->name;
     
        if ($details >= System::DATA_LIST) {
            $data->ios_code = $this->ios_code;
            $data->continent = $this->continent;
            $data->search_text = $this->search_text;
            $data->removed = $this->removed;
        }

        if ($details >= System::DATA_DETAILS) {
            $data->ios_code = $this->ios_code;
            $data->continent = $this->continent;
            $data->search_text = $this->search_text;
            $data->removed = $this->removed;
        }

        return $data;
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
