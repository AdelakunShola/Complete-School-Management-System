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


        $save_url = null;
        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'upload/student/' . $name_gen;
            Image::make($image)->resize(300, 300)->save($save_url);
        }

        // Generate librarian ID
        $student_number = IdGenerator::generate([
            'table' => 'students',
            'field' => 'student_id',
            'length' => 7,
            'prefix' => 'ID',
            'suffix' => '',
        ]);



        // For documents, use different upload paths
$tcertificateUploadPath = 'public/tcertificates';
$birthCertificateUploadPath = 'public/birth_certificates';

$tcertificatePath = $request->file('transfer_cert') ? $request->file('transfer_cert')->storeAs($tcertificateUploadPath, 'transfer_cert_' . uniqid() . '.' . $request->file('transfer_cert')->getClientOriginalExtension()) : null;

$birthCertificatePath = $request->file('birth_cert') ? $request->file('birth_cert')->storeAs($birthCertificateUploadPath, 'birth_cert_' . uniqid() . '.' . $request->file('birth_cert')->getClientOriginalExtension()) : null;



        StudentHouse::insert([

            'student_id' => $student_number,
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'birthday' => $request->birthday,
            'age' => $request->age,
            'sex' => $request->sex,
            'tribe' => $request->tribe,
            'state_of_origin' => $request->state_of_origin,

            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'address' => $request->address,
            'city' => $request->city,
            'club_id' => $request->club_id,
            'house_id' => $request->house_id,
            'state' => $request->state,
            'nationality' => $request->nationality,
            'email' => $request->email,
            'phone' => $request->phone,
            
            'password' => Hash::make($request-> password),
            'prev_sch_attended' => $request->prev_sch_attended,
            'prev_sch_address' => $request->prev_sch_address,
            'date_of_leaving_prev_sch' => $request->date_of_leaving_prev_sch,
            'reason_of_leaving_prev_sch' => $request->reason_of_leaving_prev_sch,
            'class_in_prev_sch' => $request->class_in_prev_sch,
            'physical_handicap' => $request->physical_handicap,
            'transport_id' => $request->transport_id,
            'student_category_id' => $request->student_category_id, 
            'hostel_id' => $request->hostel_id,

            'session' => $request->session,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,

            'transfer_cert' => $tcertificatePath,
            'birth_cert' => $birthCertificatePath,
            'photo' => $save_url,

            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Student Added Successfully',
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
