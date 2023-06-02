<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class SubExport implements FromCollection,WithHeadings,WithColumnWidths
{
    private $sub_id;
    public function __construct($sub_id)
    {
        $this->sub_id = $sub_id;
    }
    public function collection()
    {
        $allData = DB::table('submissions')->where('submissions.id',$this->sub_id)
                    ->join('owners','owners.submission_id','submissions.id')
                    ->join('applicants','applicants.submission_id','submissions.id')
                    ->select('building_number','contract_type','owners.name as owner_name','owners.national_id as owner_national_id'
                    ,'owners.phone as owner_phone','zone','plad_num','applicants.name as application_name','applicants.national_id as application_national_id'
                    ,'applicants.phone as application_phone','contract_number','contract_date','contract_area','contract_source','contract_status','total_area',
                    'submissions.building_type','submission_desc','operation_type')
                    ->get();
        return $allData;
    }
    public function headings(): array
    {
        return ['رقم العقار','نوع الملكية','أسم المالك','رقم الهوية','رقم الجوال','رقم المنطقة','رقم اللوحة','أسم الوكيل',
        'رقم هويةالوكيل','رقم جوال الوكيل','رقم الصك','تاريخ الصك','المساحة حسب الصك','مصدر الصك','حالة الصك','المساحة الأجمالية للمبني','نوع العقار'
        ,'وصف العقار','نوع المعاملة'];
        
    }
    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 20,
        ];
    }
}
