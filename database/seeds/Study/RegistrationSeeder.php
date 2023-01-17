<?php

use App\Models\Study\Offering;
use App\Models\Study\OfferingMark;
use App\Models\Study\Registration;
use App\Models\Users\Student;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        // $term = \App\Models\Study\Term::current(\App\Models\Study\Term::TYPE_FALL);
        // $program_ids = \App\Models\Programs\Program::pluck('id')->toArray();
        // $instructor_ids = \App\Models\Users\Instructor::pluck('id')->toArray();
        // $offering_mark_ids = Mark::pluck('id')->toArray();

        //to remove old registration and old marks
        $oldRegistrations=Registration::where('offering_id','<=',10);
        foreach ($oldRegistrations->get() as $reg){
            \App\Models\Study\RegistrationMark::where('registration_id',$reg->id)->delete();
        }
        $oldRegistrations->delete();
        //
        
        $offering_ids = Offering::where('id','<=',10)->pluck('id')->toArray();
        $student_ids = Student::limit(500)->pluck('id')->toArray();

        $rand_students = array_random($student_ids, rand(10, 40));

         foreach ($offering_ids as $offering) {
             $offeringMarkIds=OfferingMark::where('offering_id',$offering)->pluck('id')->toArray();
             $syncMarks=[];
             foreach ($offeringMarkIds as $marksId){
                $syncMarks[$marksId]=['value'=>rand(5,40)];
             }
             foreach ($rand_students as $student) {
                 $registration = new Registration();
                 $registration->offering_id = $offering;
                 $registration->student_id = $student;
                 $registration->total = rand(50, 300);
                 $registration->gpa = rand(1, 4);
                 $registration->save();

                 //to set marks
                 if(count($syncMarks)){
                     $registration->registrationOfferingMarks()->sync($syncMarks);
                 }
             }
         }


//         $students= Student::get();
//         foreach ($students as $student) {
//             $i=1;
//             foreach($student->registrations as $registration){
//                 Registration::find($registration->pivot->id)->registrationMarks()->sync( [$i++=>['value'=>rand(0,40)], $i++=>['value'=>rand(0,35)], $i++=>['value'=>rand(0,60)],$i++=>['value'=>rand(0,90) ] ]);
//             }
//         }
        

        
        // // $rand_offering_marks = array_random($offering_mark_ids, rand(10, 300));

        // $offering_marks = [];
        // foreach ($rand_offering_marks as $offering_mark) {
        //     $offering_marks[$offering_mark] = ['value' => rand(10, 60)];
        // }
        // $registration->offeringMarks()->sync($offering_marks);
    
    }
}
