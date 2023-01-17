<?php

namespace App\Http\Requests\department;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Users\Department;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
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

        $rules= [
            'faculty_id' => 'required|exists:faculties,id',
            'name'=>'required|string|max:255',
            'name_local'=>'required|string|max:255',
            'code' => [
                'required','string',
                Rule::unique('departments', 'code')->ignore($this->department)
            ]
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'=>[
                "ar"=>"الاسم باللغة الانجليزية مطلوب",
                "en"=>"English Name required"
            ],
            'name.string'=>[
                "ar"=>"يجب ادخال حروف فقط",
                "en"=>"String only accepted in field"
            ],
            'name.max'=>[
                "ar"=>"الحد الاقصي للحقل 255",
                "en"=>"max length is 255"
            ],
            'name_local.required'=>[
                "ar"=>"الاسم باللغة العربية مطلوب",
                "en"=>"Arabic Name required"
            ],
            'name_local.string'=>[
                "ar"=>"يجب ادخال حروف فقط",
                "en"=>"String only accepted in field"
            ],
            'name_local.max'=>[
                "ar"=>"الحد الاقصي للحقل 255",
                "en"=>"max length is 255"
            ],
            'code.required'=>[
                "ar"=>"كود الجامعة مطلوب",
                "en"=>"English Name required"
            ],
            'code.string'=>[
                "ar"=>"يجب ادخال حروف فقط",
                "en"=>"String only accepted in field"
            ],
            'code.unique'=>[
                "ar"=>"مسّجل بالفعل",
                "en"=>"Already Exist"
            ],
            'faculty_id.required'=>[
                "ar"=>"الكلية مطلوبه",
                "en"=>"Faculty required"
            ],
            'faculty_id.exist'=>[
                "ar"=>"غير موجودة",
                "en"=>"Not found"
            ],

        ];
    }


}
