<?php

namespace App\Http\Requests\Student\Applicant;

use Illuminate\Foundation\Http\FormRequest;

class AcceptDesire extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'applicant_id'=> 'required|numeric|exists:applicants,id',
            'faculty_id'=> 'required|numeric|exists:faculties,id',
            'program_id'=> 'required|numeric|exists:programs,id'
        ];
    }
}
