<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Classes;
use App\Models\SchoolClub;
use App\Models\SchoolHostel;
use App\Models\SchoolSubject;
use App\Models\Section;
use App\Models\Settings;
use App\Models\Student;
use App\Models\StudentCategory;
use App\Models\StudentHouse;
use App\Models\TransportRoute;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageStudentController extends Controller
{

    public function AllStudent(){
        $allstudent = Student::latest()->get();
        return view('backend.managestudent.all_student',compact('allstudent'));
    }//end method


    public function AddStudent(){
        $classes = Classes::latest()->get();
        $section = Section::latest()->get();
        $setting = Settings::find(1);
        $house = StudentHouse::latest()->get();
        $club = SchoolClub::latest()->get();
        $hostel = SchoolHostel::latest()->get();
        $transports = TransportRoute::latest()->get();
        $studentcategory = StudentCategory::latest()->get();
        $parents = User::where('role', 'parent')->get();
        return view('backend.managestudent.add_student',compact('setting','section','classes','house','club','hostel','transports','studentcategory','parents'));
    }//end method



    public function StoreStudent(Request $request){

        // Generate librarian ID
        $student_number = IdGenerator::generate([
            'table' => 'students',
            'field' => 'student_id',
            'length' => 7,
            'prefix' => 'ID'
        ]);


        Classes::insert([

            'student_id' => $student_number,
            'name' => $request->description,
            'email' => $request->name,
            'birthday' => $request->description,
            'age' => $request->name,
            'tribe' => $request->description,
            'state_of_origin' => $request->name,
            'password' => Hash::make($request-> password),

            'religion' => $request->description,
            'sex' => $request->name,
            'blood_group' => $request->description,
            'photo' => $request->name,
            'phone' => $request->description,
            'address' => $request->name,
            'city' => $request->description,
            'state' => $request->name,

            'nationality' => $request->description,
            'physical_handicap' => $request->name,
            'prev_sch_attended' => $request->name,
            'prev_sch_address' => $request->description,
            'date_of_leaving_prev_sch' => $request->name,
            'reason_of_leaving_prev_sch' => $request->description,
            'class_in_prev_sch' => $request->name,
            'class_id' => $request->description,

            'section_id' => $request->name,
            'parent_id' => $request->description,
            'transport_id' => $request->name,
            'student_category_id' => $request->description,
            'club_id' => $request->name,
            'house_id' => $request->description,
            'hostel_id' => $request->name,
            'session' => $request->session,

            'status' => $request->name,
            'facebook' => $request->description,
            'twitter' => $request->name,
            'linkedin' => $request->description,

            'transfer_cert' => $request->description,
            'birth_cert' => $request->name,

            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Class Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 




    public function getSectionByClass($class_id)
{
    $sections = Section::where('class_id', $class_id)->get();
    return response()->json($sections);
}



   




























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
