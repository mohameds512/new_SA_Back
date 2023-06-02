<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportIncludes implements FromCollection,WithColumnWidths,WithHeadings
{
    private $sub_id;
    public function __construct($sub_id)
    {
        $this->sub_id = $sub_id;
    }
    public function collection()
    {
        $allData = DB::table('includes')
        ->join('building_types', 'building_types.id', 'includes.build_id')
        ->join('building_type_contents', 'building_type_contents.id', 'includes.build_desc_id')
        ->select('building_types.name as type_name','building_type_contents.name as desc_name','building_type_contents.unit', 'includes.qty')
        ->where('includes.submission_id',$this->sub_id)
        ->get();
        $col_allData = $allData->map(function($data,$index){
            return[
                'num'=>$index+1,
                'type_name'=>$data->type_name,
                'desc_name'=>$data->desc_name,
                'unit'=>$data->unit,
                'qty'=>$data->qty,
            ];
        });
        return $col_allData;
    }
    public function headings(): array
    {
        return ['الرقم','نوع المشتمل','وصف المشتمل','الوحدة','العدد/المساحة'];
        
    }
    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 40,
            'C' => 30,
            'D' => 10,
            'E' => 10,
        ];
    }
}
