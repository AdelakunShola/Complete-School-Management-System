<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\SchoolSubject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function ManageSubject(){
        $subject = SchoolSubject::latest()->get();
        $teachers = User::where('role', 'teacher')->get();
        $classes = Classes::latest()->get();
        return view('backend.schoolsubject.manage_subject',compact('subject','teachers','classes'));
    }//end method


    public function EditSubject($id){
        $subject = SchoolSubject::find($id);
        return response()->json($subject);
    }// End Method 


    public function StoreSubject(Request $request){
        SchoolSubject::insert([
            
            'name' => $request->name,
            'class_id' => $request->class_id,
            'teacher_id' => $request->teacher_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Subject Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateSubject(Request $request){
        $subject_id = $request->subject_id;
        SchoolSubject::find($subject_id)->update([
            'name' => $request->name,
            'class_id' => $request->class_id,
            'teacher_id' => $request->teacher_id,
        ]);
        $notification = array(
            'message' => 'Subject Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteSubject($id){
        SchoolSubject::find($id)->delete();
        $notification = array(
            'message' => 'Subject Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
