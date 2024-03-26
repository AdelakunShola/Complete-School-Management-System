<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StudentCategory;
use App\Models\StudentHouse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageStudentController extends Controller
{
    




























//////////////////STUDENT HOUSE///////////////////////


    public function StudentHouse(){
        $studenthouse = StudentHouse::latest()->get();
        return view('backend.managestudent.student_house',compact('studenthouse'));
    }//end method


    public function EditStudentHouse($id){
        $studenthouse = StudentHouse::find($id);
        return response()->json($studenthouse);
    }// End Method 


    public function StoreStudentHouse(Request $request){
        StudentHouse::insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Student House Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateStudentHouse(Request $request){
        $studenthouse_id = $request->studenthouse_id;
        StudentHouse::find($studenthouse_id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $notification = array(
            'message' => 'Student House Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteStudentHouse($id){
        StudentHouse::find($id)->delete();
        $notification = array(
            'message' => 'Student House Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 









    /////////////STUDENT CATEGORY////////


    public function StudentCategory(){
        $studentcategory = StudentCategory::latest()->get();
        return view('backend.managestudent.student_category',compact('studentcategory'));
    }//end method


    public function EditStudentCategory($id){
        $studentcategory = StudentCategory::find($id);
        return response()->json($studentcategory);
    }// End Method 


    public function StoreStudentCategory(Request $request){
        StudentCategory::insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Student Category Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateStudentCategory(Request $request){
        $studentcategory_id = $request->studentcategory_id;
        StudentCategory::find($studentcategory_id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $notification = array(
            'message' => 'Student Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteStudentCategory($id){
        StudentCategory::find($id)->delete();
        $notification = array(
            'message' => 'Student Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
