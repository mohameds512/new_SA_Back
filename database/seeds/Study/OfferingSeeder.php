<?php

use App\Models\Grades\OfferingStudent;
use App\Models\Programs\Course;
use App\Models\Programs\Mark;
use App\Models\Programs\Program;
use App\Models\Study\Offering;
use App\Models\Study\OfferingMark;
use App\Models\Study\OfferingMarkCategory;
use App\Models\Study\Registration;
use App\Models\Study\Section;
use App\Models\Users\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //error_log(json_encode(Offering::where('id','<=',10)->get()));

        //to create offering and enroll students in old terms
        //reset table old data
        Offering::where('id','<=',24)->delete();
        Section::where('offering_id','<=',24)->delete();
        Registration::where('offering_id','<=',24)->delete();

        //static data   
        $terms=[145,147,148];
        $current_term=123;

        //electrical eng
        $courses= Course::where('bylaw_id',41)->limit(50)->pluck('id')->toArray();
        $program_id=10; 
        
        // $program= Program::find($program_id);
        // $program->courses()->sync($courses);
        
        $i=1;
        foreach($terms as $term){
            foreach($courses as $course){

                $courseMarks = DB::table('courses_marks_categories')->select('course_id','mark_category_id', 'max')->where('course_id', $course)->get();
                /* term 147 - Fall 2022 / STATUS_CONTROL_PUBLISHED */
                $offering=Offering::create(['id'=>$i,'course_id' => $course, 'term_id' => $term ,'status'=> 0 ]);
                // $offering->programs()->sync($program->id);

                $linkedIDs = [];
                foreach ($courseMarks as $courseMark) {
    
                    $linkedIDs[$courseMark->mark_category_id] = ['max_category' => $courseMark->max];
                }
                $offering->markCategorys()->syncWithoutDetaching($linkedIDs);

                // $offering->marks()->sync([1=>['max'=>50],2=>['max'=>50],3=>['max'=>50],4=>['max'=>50]]);
                $offeringMarkCategorys= OfferingMarkCategory::pluck('id')->toArray();

                foreach($offeringMarkCategorys as $offeringMarkCategory){
            
                    $offeringMarks=OfferingMark::create(['offering_mark_category_id' => $offeringMarkCategory, 'name' => 'mark '.$offeringMarkCategory, 'short_name' => '(mark-'.$offeringMarkCategory.')' ,'max_mark'=> 25 ]);
                }

                /* to create sections for each offering */
                $this->createRandomSections($offering->id);

                /* Register new students into above offering */
                $students= Student::where('term_id', $current_term)->where('program_id',$program_id)->get();

                foreach($students as $student){
                    // $offeringMarkIds=OfferingMark::where('offering_id',$offering->id)->pluck('id')->toArray();
                    $offeringMarkIds=OfferingMarkCategory::where('offering_id', $offering->id)->pluck('id')->toArray();
                    
                    $syncMarks=[];
                    foreach ($offeringMarkIds as $marksId){
                        $syncMarks[$marksId]=['value'=>rand(5,254)];
                    }

                    $registration = new Registration();
                    $registration->offering_id = $offering->id;
                    $registration->student_id = $student->id;
                    $registration->total = rand(50, 100);
                    $registration->gpa = rand(0, 4);
                    $registration->status=Registration::STATUS_REGISTERED;
                    //to add student registration in section
                    $registration->section_id=Section::inRandomOrder()->select('id')->where('offering_id',$offering->id)->first()->id;
                    $registration->save();

                    //to set marks
                    if(count($syncMarks)){
                        $registration->registrationMarks()->sync($syncMarks);
                    }

                    //to sync student with role student
                    $student->user->syncRoles(['student']);
                }
                $i++;

            }
        } 
    }

    public function createRandomSections($offering_id){
        $sections=rand(1,4);
        for($i=1;$i<=$sections;$i++){
            Section::create(['offering_id'=>$offering_id,'group'=>1,'section'=>$i,'quota'=>30,'over_quota'=>10]);
        }
    }
   
 
}
