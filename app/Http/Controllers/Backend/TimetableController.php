<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\SchoolSubject;
use App\Models\Section;
use App\Models\Settings;
use App\Models\Timetable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimetableController extends Controller
{


    public function AllTimetable(){
        $timetable = Timetable::latest()->get();
        $section = Section::latest()->get();
        $sections = Section::latest()->get();
        $classes = Classes::latest()->get();
        $subject = SchoolSubject::latest()->get();
        return view('backend.timetable.all_timetable',compact('timetable','classes','section','subject','sections'));
    }
    
    public function AddTimetable(){
        $timetable = Timetable::latest()->get();
        $section = Section::latest()->get();
        $classes = Classes::latest()->get();
        $subject = SchoolSubject::latest()->get();
        
        return view('backend.timetable.add_timetable',compact('timetable','classes','section','subject'));
    }


    public function StoreTimetable(Request $request){
        Timetable::insert([
            
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subjects_id' => $request->subjects_id,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'time_start_min' => $request->time_start_min,
            'time_end_min' => $request->time_end_min,
            'start_day_period' => $request->start_day_period,
            'end_day_period' => $request->end_day_period,
            'day' => $request->day,
            'year' => $request-> year,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Class Timetable / Class Routine Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.timetable')->with($notification); 
    }// End Method 



    public function EditTimetable($id){
        $timetable = Timetable::findOrFail($id);
        $section = Section::latest()->get();
        $classes = Classes::latest()->get();
        $subject = SchoolSubject::latest()->get();
        return view('backend.timetable.edit_timetable',compact('timetable','classes','section','subject'));
    }



    public function UpdateTimetable(Request $request){


        $timetable = $request->id;
        Timetable::find($timetable)->update([

            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'subjects_id' => $request->subjects_id,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'time_start_min' => $request->time_start_min,
            'time_end_min' => $request->time_end_min,
            'start_day_period' => $request->start_day_period,
            'end_day_period' => $request->end_day_period,
            'day' => $request->day,
            'year' => $request-> year,

        ]);
        $notification = array(
            'message' => 'Timetable Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.timetable')->with($notification); 

    }









    public function ViewTimetable($class_id, $section_id){
        $timetable = Timetable::where('class_id', $class_id)
                                ->where('section_id', $section_id)
                                ->get();
        $classes = Classes::latest()->get();
        $setting = Settings::latest()->get();
        $section = Section::find($section_id);
        $sections = Section::latest()->get();
        $subject = SchoolSubject::latest()->get();
        return view('backend.timetable.view_timetable',compact('classes','section','subject','timetable','sections','setting'));
    }



    public function ShowDetails($class_id) {
        $class = Classes::findOrFail($class_id); // Assuming your class model is named `Class`
    
        // Fetch sections for the selected class
        $sections = $class->sections()->get(); // Assuming there's a relationship between Class and Section
        $timetable = Timetable::latest()->get();
        $section = Section::latest()->get();
        $classes = Classes::latest()->get();
        $subject = SchoolSubject::latest()->get();
       
    
        // Pass $class and $sections to the view and return the view
        return view('backend.timetable.partial', compact('class', 'sections','classes','timetable','subject','section'));
    }
    





    
    









// TimetableController
public function GetTimetable(Request $request) {
        // Retrieve class ID from the request
        $classId = $request->input('class_id');
    
        // Retrieve sections for the given class
        $sections = \App\Models\Section::where('class_id', $classId)->get();
        
        // Initialize an array to store timetable data for each section
        $timetableData = [];
        
        // Iterate over each section
        foreach ($sections as $section) {
            // Fetch timetable entries for the current section
            $timetableEntries = Timetable::where('class_id', $classId)
                                          ->where('section_id', $section->id)
                                          ->get();
            
            // Store timetable entries in the timetableData array, keyed by section name
            $timetableData[$section->name] = $timetableEntries;
        }
    return view('backend.timetable.add_timetable');
}




    public function GetSubject($subject_id){
        $subcat = SchoolSubject::where('class_id',$subject_id)->orderBy('name','ASC')->get();
            return json_encode($subcat);
    }// End Method


    public function getSectionsByClass($class_id)
{
    $sections = Section::where('class_id', $class_id)->get();
    return response()->json($sections);
}



public function DeleteTimetable($id){
    Timetable::find($id)->delete();
    $notification = array(
        'message' => 'Timetable Deleted Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);

}// End Method 

}
