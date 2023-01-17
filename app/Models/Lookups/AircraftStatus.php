<?php

namespace App\Models\Lookups;

use Illuminate\Database\Eloquent\Model;
use App\Models\System\System;

class AircraftStatus extends Model
{
    protected $table ="aircraft_status";
    protected $fillable = [
        'name'
    ];

    public function save(array $options = [])
    {
        $name = "$this->name";
        $text = "$this->name";
        $text = "#$this->id, " . getFTS($text) . ", $name ";
        $this->search_text = $text;
        parent::save($options);
    }

    public function data($details = System::DATA_BRIEF)
    {

        $data = (object)[];

        $data->id = $this->id;
        $data->name = $this->name;
        $data->search_text = $this->search_text;
        $data->removed = $this->removed;

        if ($details >= System::DATA_LIST) {

            $data->id = $this->id;
            $data->name = $this->name;
            $data->search_text = $this->search_text;
            $data->removed = $this->removed;
        }

        if ($details >= System::DATA_DETAILS) {

            $data->id = $this->id;
            $data->name = $this->name;
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
