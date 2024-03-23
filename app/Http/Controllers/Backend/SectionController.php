<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function ManageSection(){
        $section = Section::latest()->get();
        $teachers = User::where('role', 'teacher')->get();
        $classes = Classes::latest()->get();
        return view('backend.schoolsection.manage_section',compact('section','teachers','classes'));
    }//end method


    public function EditSection($id){
        $section = Section::find($id);
        return response()->json($section);
    }// End Method 


    public function StoreSection(Request $request){
        Section::insert([
            
            'name' => $request->name,
            'nick_name' => $request->nick_name,
            'class_id' => $request->class_id,
            'teacher_id' => $request->teacher_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Section Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateSection(Request $request){
        $section_id = $request->section_id;
        Section::find($section_id)->update([
            'name' => $request->name,
            'nick_name' => $request->nick_name,
            'class_id' => $request->class_id,
            'teacher_id' => $request->teacher_id,
        ]);
        $notification = array(
            'message' => 'Section Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteSection($id){
        Section::find($id)->delete();
        $notification = array(
            'message' => 'Section Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
