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
        $classes = Classes::latest()->get();
        $section = Section::latest()->get();
        $setting = Settings::find(1);
        $house = StudentHouse::latest()->get();
        $club = SchoolClub::latest()->get();
        $hostel = SchoolHostel::latest()->get();
        $transports = TransportRoute::latest()->get();
        $studentcategory = StudentCategory::latest()->get();
        $parents = User::where('role', 'parent')->get();
        return view('backend.managestudent.all_student',compact('allstudent','setting','section','classes','house','club','hostel','transports','studentcategory','parents'));
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

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
      
      ]);


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


    $tcertificatePath = $request->file('transfer_cert') ? 
    $request->file('transfer_cert')->move('public/tcertificates', 'transfer_cert_' . uniqid() . '.' . $request
    ->file('transfer_cert')->getClientOriginalExtension()) : null;


    $birthCertificatePath = $request->file('birth_cert') ? 
    $request->file('birth_cert')->move('public/birth_certificates', 'birth_cert_' . uniqid() . '.' . $request
    ->file('birth_cert')->getClientOriginalExtension()) : null;

    

        Student::insert([

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
        return redirect()->route('all.student')->with($notification);
    }// End Method 




    public function EditStudent($id){

        $editStudent = Student::findOrFail($id);
        $classes = Classes::latest()->get();
        $sections = Section::latest()->get();
        $setting = Settings::find(1);
        $house = StudentHouse::latest()->get();
        $club = SchoolClub::latest()->get();
        $hostel = SchoolHostel::latest()->get();
        $transports = TransportRoute::latest()->get();
        $studentcategory = StudentCategory::latest()->get();
        $parents = User::where('role', 'parent')->get();

        $selectedParentId = $editStudent->parent_id;

        return view('backend.managestudent.edit_student',compact('editStudent','setting','sections','classes','house','club','hostel','transports','studentcategory','parents','selectedParentId'));
    }//end method




    public function UpdateStudent(Request $request){

        $student_id = $request->id;
        $data = Student::findOrFail($student_id);

    
        $data->update([
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

            
        ]);


        // Check if a new photo has been uploaded
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/student/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);
    
            // Update the photo field with the full path
            $data->update(['photo' => 'upload/student/' . $filename]);
        }


        // Check if a new transfer certificate has been uploaded
        if ($request->file('transfer_cert')) {
            $file = $request->file('transfer_cert');
            @unlink(public_path('public/tcertificates/' . $data->transfer_cert));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/tcertificates'), $filename);
    
            // Update the certificate field with the full path
            $data->update(['transfer_cert' => 'public/tcertificates/' . $filename]);
        }



        // Check if a new Birth certificate has been uploaded
        if ($request->file('birth_cert')) {
            $file = $request->file('birth_cert');
            @unlink(public_path('public/birth_certificates/' . $data->birth_cert));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/birth_certificates'), $filename);
    
            // Update the certificate field with the full path
            $data->update(['birth_cert' => 'public/birth_certificates/' . $filename]);
        }
       
        $notification = [
            'message' => 'Student Profile Updated Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.student')->with($notification);
    }//end method
       
   


    public function ViewStudent($id){

        $editStudent = Student::findOrFail($id);
        $classes = Classes::latest()->get();
        $sections = Section::latest()->get();
        $setting = Settings::find(1);
        $house = StudentHouse::latest()->get();
        $club = SchoolClub::latest()->get();
        $hostel = SchoolHostel::latest()->get();
        $transports = TransportRoute::latest()->get();
        $studentcategory = StudentCategory::latest()->get();
        $parents = User::where('role', 'parent')->get();

        $selectedParentId = $editStudent->parent_id;

        return view('backend.managestudent.view_student',compact('editStudent','setting','sections','classes','house','club','hostel','transports','studentcategory','parents','selectedParentId'));
    }//end method


    public function DeleteStudent($id) {
        $student = Student::find($id);
        
        // Check if the student exists
        if ($student) {
            // Construct the full path to the image
            $imagePath = public_path('upload/student/' . $student->photo);
            
            // Check if the image exists before attempting to delete it
            if (file_exists($imagePath)) {
                // Delete the image file
                @unlink($imagePath);
            }
    
            // Delete the student record from the database
            $student->delete();
    
            $notification = [
                'message' => 'Student details deleted successfully',
                'alert-type' => 'success',
            ];
    
            return redirect()->back()->with($notification);
        }
    
        $notification = [
            'message' => 'Student not found',
            'alert-type' => 'error',
        ];
    
        return redirect()->back()->with($notification);
    }
    




    







    public function getSectionByClass($class_id){

        $sections = Section::where('class_id', $class_id)->get();
        return response()->json($sections);
       
        }//end method



   




























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
