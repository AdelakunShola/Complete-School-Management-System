<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function ManageClasses(){
        $classes = Classes::latest()->get();
        $teachers = User::where('role', 'teacher')->get();
        return view('backend.manageclasses.manage_class',compact('classes','teachers'));
    }//end method


    public function EditClass($id){
        $classes = Classes::find($id);
        return response()->json($classes);
    }// End Method 


    public function StoreClass(Request $request){
        Classes::insert([
            'class_name' => $request->class_name,
            'numeric_name' => $request->numeric_name,
            'teacher_id' => $request->teacher_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Class Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateClass(Request $request){
        $class_id = $request->class_id;
        Classes::find($class_id)->update([
            'class_name' => $request->class_name,
            'numeric_name' => $request->numeric_name,
            'teacher_id' => $request->teacher_id,
        ]);
        $notification = array(
            'message' => 'Class Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteClass($id){
        Classes::find($id)->delete();
        $notification = array(
            'message' => 'Class Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
