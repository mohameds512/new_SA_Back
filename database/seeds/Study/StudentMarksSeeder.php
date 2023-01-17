<?php

use App\Models\Study\Offering;
use App\Models\Study\OfferingMark;
use App\Models\Study\Registration;
use App\Models\Study\RegistrationMark;
use Illuminate\Database\Seeder;

class StudentMarksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $registrations = Registration::pluck('id')->toArray();
        
        
        $rand_offering_marks = OfferingMark::pluck('id')->toArray();


        // $rand_offering_marks = OfferingMark::pluck('id','offering_id')->toArray();
        
        
        // foreach ($registrations as $registration) {
            
            //     foreach ($rand_offering_marks as $offering_mark) {
                
        //         $registration_mark = new RegistrationMark();
        //         $registration_mark->registration_id = $registration;
        //         $registration_mark->offering_mark_id = $offering_mark;
        //         $registration_mark->value = 0;
        //         $registration_mark->save();
        //     }
        
        // }
        
        
        $rand_offering_marks = OfferingMark::pluck('id')->toArray();
        $registrations = Registration::pluck('id')->toArray();
        // $registrations= Registration::get();
        $offerings= Offering::pluck('id')->toArray();
        
        // foreach($registrations as $registration){
            
            foreach($registrations as $registration){
                $i=1;
                OfferingMark::find($registration)->registrations()
                ->sync( 
                    [
                        $i++=>['value'=>rand(0,40)], 
                        $i++=>['value'=>rand(0,35)], 
                        $i++=>['value'=>rand(0,60)],
                        $i++=>['value'=>rand(0,90) ] 
                    ]);
                }
                // }
                
                // foreach($rand_offering_marks as $offering){
                //     $i=1;
                //     Registration::find($offering)->offeringMarks()
                //     ->sync( 
                //         [
                //             $i++=>['value'=>rand(0,40)], 
                //             $i++=>['value'=>rand(0,35)], 
                //             $i++=>['value'=>rand(0,60)],
                //             $i++=>['value'=>rand(0,90) ] 
                //         ]);
                // }
                



    }
}
