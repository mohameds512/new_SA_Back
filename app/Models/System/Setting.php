<?php

namespace App\Models\System;

use App\Models\Common\PreUniversityCertificate;
use App\Models\Common\PreUniversityCertificateType;
use App\Models\Programs\Bylaw;
use App\Models\Programs\Faculty;
use App\Models\Programs\Program;
use App\Models\Study\Term;
use Carbon\Carbon;
use http\Params;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $guarded = [];

    protected $casts = ['value' => 'json'];

    public static function of($name, $params = [])
    {

        $faculty_id = array_get($params, 'faculty_id', null);
        $bylaw_id = array_get($params, 'bylaw_id', null);
        $program_id = array_get($params, 'program_id', null);
        $term_id = array_get($params, 'term_id', null);

        $term = Term::current(Term::TYPE_ADMISSION);

        if ($term) {
            $query = Setting::whereNameAndTermId($name, $term->id);

            $query = $faculty_id ? $query->whereFacultyId($faculty_id) : $query;
            $query = $bylaw_id ? $query->whereBylawId($bylaw_id) : $query;
            $query = $program_id ? $query->whereProgramId($program_id) : $query->whereNull('program_id');

            $setting = $query->first();

            if ($setting) return (object)$setting->value;
        }

        return false;

    }

    public static function getCurrentBylaws()
    {
        $year = Carbon::now()->year;
        $bylaws_ids = [];
        $bylaws = Setting::whereNameAndYear('ADMISSION_SETTINGS', $year)->get();
        foreach ($bylaws as $bylaw) {
            if ($bylaw->value && $bylaw->value['current_bylaw_id']) {
                $bylaws_ids[] = $bylaw->value['current_bylaw_id'];
            }
        }
        return $bylaws_ids;
    } // not used

    public static function getProgramsIdsOf()
    {
        $term = Term::current(Term::TYPE_ADMISSION);
        $programs_ids = [];
        if ($term) {
            $programs_ids = Setting::whereTermId($term->id)->whereIn('name', ['ADMISSION_SETTINGS', 'ADMISSION_PAYMENTS_SETTINGS'])->whereNotNull('program_id')->pluck('program_id')->toArray();
        }
        return $programs_ids;
    }

    public static function getFacultiesIdsOf($applicant)
    {

        $term = Term::current(Term::TYPE_ADMISSION);
        if ($term) {
            $settings = Setting::whereNameAndTermId('ADMISSION_SETTINGS', $term->id)->get();
            return $settings->filter(function ($item, $key) use ($applicant) {
                $value = $item->value;

                $current_year = date('Y');

                $certificate_approved = true;

                if ($applicant->year == $current_year) {
                    if (isset($value['minimum_grade']) && $value['minimum_grade']) {
                        $certificate_approved = (isset($applicant->data['certificate_percentage']) && $applicant->data['certificate_percentage'] >= $value['minimum_grade']);
                    }
                } else {
                    if (isset($value['prev_minimum_grade']) && $value['prev_minimum_grade']) {
                        $certificate_approved = (isset($applicant->data['certificate_percentage']) && $applicant->data['certificate_percentage'] >= $value['prev_minimum_grade']);
                    }
                }


                $certificate_type_approved = true;

                if (isset($value['certificate_type']) && $value['certificate_type']) {

                    $value['certificate_type'] = is_array($value['certificate_type']) ? $value['certificate_type'] : [$value['certificate_type']];

                    if ($value['certificate_type'] && is_array($value['certificate_type']) && count($value['certificate_type'])) {
                        if (isset($applicant->data['pre_university_certificate']) && $applicant->data['pre_university_certificate'] && isset($value['pre_university_certificate']) && $value['pre_university_certificate'] == $applicant->data['pre_university_certificate']) {
                            $certificate_type_approved = (isset($applicant->data['pre_university_certificate_type']) && in_array($applicant->data['pre_university_certificate_type'], $value['certificate_type']));
                            return ($certificate_approved && $certificate_type_approved);
                        }
                    }
                }


                $biology_approved = true;
                if (isset($value['biology']) && $value['biology']) {
                    $biology_approved = (isset($applicant->data['biology']) && $applicant->data['biology']);
                }

                $arabic_approved = true;
                if (isset($value['arabic']) && $value['arabic']) {
                    $biology_approved = (isset($applicant->data['arabic']) && $applicant->data['arabic']);
                }

                $french_approved = true;
                if (isset($value['french']) && $value['french']) {
                    $biology_approved = (isset($applicant->data['french']) && $applicant->data['french']);
                }

                $german_approved = true;
                if (isset($value['german']) && $value['german']) {
                    $biology_approved = (isset($applicant->data['german']) && $applicant->data['german']);
                }

                $italy_approved = true;
                if (isset($value['italy']) && $value['italy']) {
                    $biology_approved = (isset($applicant->data['italy']) && $applicant->data['italy']);
                }

                $advanced_math_approved = true;
                if (isset($value['advanced_math']) && $value['advanced_math']) {
                    $biology_approved = (isset($applicant->data['advanced_math']) && $applicant->data['advanced_math']);
                }


                $chemistry_approved = true;
                if (isset($value['chemistry']) && $value['chemistry']) {
                    $chemistry_approved = (isset($applicant->data['chemistry']) && $applicant->data['chemistry'] > 0);
                }

                $english_approved = true;
                if (isset($value['english']) && $value['english']) {
                    $english_approved = (isset($applicant->data['english']) && $applicant->data['english'] > 0);
                }

                $math_approved = true;
                if (isset($value['math']) && $value['math']) {
                    $math_approved = (isset($applicant->data['math']) && $applicant->data['math'] > 0);
                }


                $physics_approved = true;
                if (isset($value['physics']) && $value['physics']) {
                    $physics_approved = (isset($applicant->data['physics']) && $applicant->data['physics'] > 0);
                }

                return ($certificate_approved && $math_approved && $physics_approved && $english_approved
                    && $chemistry_approved && $biology_approved && $advanced_math_approved
                    && $arabic_approved && $italy_approved && $french_approved && $german_approved && $certificate_type_approved);

            })->pluck('faculty_id')->toArray();
        }
        return [];

    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function bylaw()
    {
        return $this->belongsTo(Bylaw::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }


    public function data($details = System::DATA_BRIEF)
    {

        $data = (object)[];
//
        $data->id = $this->id;
        $data->year = $this->year;
        $data->name = $this->name;
        $data->value = $this->value;
        if ($details >= System::DATA_LIST) {
            $data->faculty = $this->faculty ? $this->faculty->data(System::DATA_BRIEF) : null;
            $data->bylaw = $this->bylaw ? $this->bylaw->data(System::DATA_BRIEF) : null;
            $data->program = $this->program ? $this->program->data(System::DATA_BRIEF) : null;
            $data->term = $this->term ? $this->term->data(System::DATA_BRIEF) : null;
        }

        if ($details >= System::DATA_DETAILS) {
            $data->data = $this->value;
        }


        return $data;
    }
}
