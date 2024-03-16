<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{
    public function AllTeacher(){
        $departments = Department::latest()->get();
        $all_teacher = User::where('role', 'teacher')->latest()->get();
        return view('backend.teacher.all_teacher', compact('all_teacher','departments'));
    }//end method


    public function AddTeacher(){
        $departments = Department::latest()->get();
        $designations = Designation::latest()->get();
        return view('backend.teacher.add_teacher',compact('departments','designations'));
    }//end method


    public function StoreTeacher(Request $request) {
        $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:users',
        
        ]);

        $save_url = null;
        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'upload/teacher/' . $name_gen;
            Image::make($image)->resize(300, 300)->save($save_url);
        }

    
        // Generate HRM ID
        $teacher_number = IdGenerator::generate([
            'table' => 'users',
            'field' => 'teacher_id',
            'length' => 7,
            'prefix' => 'TCH'
        ]);


// For documents, use different upload paths
$certificateUploadPath = 'public/certificates';
$nyscCertificateUploadPath = 'public/nysc_certificates';
$additionalDocumentUploadPath = 'public/additional_documents';
$additionalDocument2UploadPath = 'public/additional_documents2';

$certificatePath = $request->file('certificate') ? $request->file('certificate')->storeAs($certificateUploadPath, 'certificate_' . uniqid() . '.' . $request->file('certificate')->getClientOriginalExtension()) : null;

$nyscCertificatePath = $request->file('nysc_certificate') ? $request->file('nysc_certificate')->storeAs($nyscCertificateUploadPath, 'nysc_certificate_' . uniqid() . '.' . $request->file('nysc_certificate')->getClientOriginalExtension()) : null;

$additionalDocumentPath = $request->file('additional_document') ? $request->file('additional_document')->storeAs($additionalDocumentUploadPath, 'additional_document_' . uniqid() . '.' . $request->file('additional_document')->getClientOriginalExtension()) : null;

$additionalDocument2Path = $request->file('additional_document2') ? $request->file('additional_document2')->storeAs($additionalDocument2UploadPath, 'additional_document2_' . uniqid() . '.' . $request->file('additional_document2')->getClientOriginalExtension()) : null;

// Now you can use these variables in your User creation




$existingUser = User::where('email', $request->input('email'))->first();

if ($existingUser) {
    return redirect()->route('add.teacher')->withErrors(['email' => 'This email is already in use. Please use another email.']);
} else {
   
        // Create a new teacher instance using dependency injection
        $teacher = new User([
            'teacher_id' => $teacher_number,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),

            'qualification' => $request->input('qualification'),
            'blood_group' => $request->input('blood_group'),
            'religion' => $request->input('religion'),
            'phone' => $request->input('phone'),
            'marital_status' => $request->input('marital_status'),

            'school_attended' => $request->input('school_attended'),
            'graduation_year' => $request->input('graduation_year'),
            'password' => Hash::make($request->input('password')),
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),

            'linkedin' => $request->input('linkedin'),
            'employment_date'  => $request->input('employment_date'),
            'end_of_employment_date'  => $request->input('end_of_employment_date'),
            'starting_salary'  => $request->input('starting_salary'),
            'department_id'  => $request->input('department_id'),
            'designation_id'  => $request->input('designation_id'),

            'photo' => $save_url,
            'certificate' => $certificatePath,
            'nysc_certificate' => $nyscCertificatePath,
            'additional_document' => $additionalDocumentPath,
            'additional_document2' => $additionalDocument2Path,
            'role' => 'teacher',
        ]);

        // Save the teacher instance to the database
        $teacher->save();

        $teacherId = $teacher->id;

        Bank::insert([

            'user_id' => $teacherId,
            'account_holder_name' => $request->input('account_holder_name'),
            'account_number' => $request->input('account_number'),
            'bank_name' => $request->input('bank_name'),
            'account_type' => $request->input('account_type'),
            'branch' => $request->input('branch'),

        ]); 
    
        

    
        $notification = [
            'message' => 'Teacher Data Inserted With Image Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.teacher')->with($notification);

    }

    }//end method
    
    
    public function ViewTeacher($id){
        $teacher = User::where('role', 'teacher')->findOrFail($id);
        return view('backend.teacher.view_teacher', compact('teacher'));
    }//end method


    public function EditTeacher($id){
        $departments = Department::latest()->get();
        $designations = Designation::latest()->get();
        $teacher = User::where('role', 'teacher')->findOrFail($id);
        $bankDetails = Bank::where('user_id', $id)->first(); // Fetch bank details for the specific user
        $teacher = User::where('role', 'teacher')->findOrFail($id);
        return view('backend.teacher.edit_teacher', compact('teacher','designations','departments','bankDetails'));
    }//end method



 
    public function updateTeacher(Request $request){

        $teacher_id = $request->id;
        $data = User::findOrFail($teacher_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher_id,
            // Other validation rules...
        ]);
    
        $data->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),

            'qualification' => $request->input('qualification'),
            'blood_group' => $request->input('blood_group'),
            'religion' => $request->input('religion'),
            'phone' => $request->input('phone'),
            'marital_status' => $request->input('marital_status'),

            'school_attended' => $request->input('school_attended'),
            'graduation_year' => $request->input('graduation_year'),
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),

            'linkedin' => $request->input('linkedin'),
            'employment_date'  => $request->input('employment_date'),
            'end_of_employment_date'  => $request->input('end_of_employment_date'),
            'starting_salary'  => $request->input('starting_salary'),
            'department_id'  => $request->input('department_id'),
            'designation_id'  => $request->input('designation_id'),
            'status' => 1,
        ]);


       
$bankDetails = Bank::where('user_id', $teacher_id)->first();

if (!$bankDetails) {
    $bankDetails = new Bank();
    $bankDetails->user_id = $teacher_id;
}

// Check if $bankDetails is not null before accessing its properties
// Check if $bankDetails is not null before accessing its properties
if ($bankDetails) {
    $bankDetails->account_holder_name = $request->input('account_holder_name');
    $bankDetails->account_number = $request->input('account_number');
    $bankDetails->bank_name = $request->input('bank_name');
    $bankDetails->account_type = $request->input('account_type');
    $bankDetails->branch = $request->input('branch');
    $bankDetails->save();
}



        
    
        // Check if a new photo has been uploaded
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/teacher/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/teacher'), $filename);
    
            // Update the photo field with the full path
            $data->update(['photo' => 'upload/teacher/' . $filename]);
        }



        // Check if a new certificate has been uploaded
        if ($request->file('certificate')) {
            $file = $request->file('certificate');
            @unlink(public_path('public/certificates/' . $data->certificate));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/certificates'), $filename);
    
            // Update the certificate field with the full path
            $data->update(['certificate' => 'public/certificates/' . $filename]);
        }


        // Check if a new nysc_certificate has been uploaded
        if ($request->file('nysc_certificate')) {
            $file = $request->file('nysc_certificate');
            @unlink(public_path('public/nysc_certificates/' . $data->nysc_certificate));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/nysc_certificates'), $filename);
    
            // Update the nysc_certificate field with the full path
            $data->update(['nysc_certificate' => 'public/nysc_certificates/' . $filename]);
        }


        // Check if a new additional_document has been uploaded
        if ($request->file('additional_document')) {
            $file = $request->file('additional_document');
            @unlink(public_path('public/additional_documents/' . $data->additional_document));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/additional_documents'), $filename);
    
            // Update the additional_document field with the full path
            $data->update(['additional_document' => 'public/additional_documents/' . $filename]);
        }



        // Check if a new additional_document2 has been uploaded
        if ($request->file('additional_document2')) {
            $file = $request->file('additional_document2');
            @unlink(public_path('public/additional_documents2/' . $data->additional_document2));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/additional_documents2'), $filename);
    
            // Update the additional_document2 field with the full path
            $data->update(['additional_document2' => 'public/additional_documents2/' . $filename]);
        }

        $notification = [
            'message' => 'Teacher Profile Updated Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.teacher')->with($notification);
    }//end method



    public function DeleteTeacher($id){
        $user = User::find($id);
    
        // Check if the user exists
        if ($user) {
            // Delete the user's photo file
            @unlink(public_path('upload/teacher/' . $user->photo));
    
            // Delete the user's bank details
            $bankDetails = Bank::where('user_id', $id)->first();
            if ($bankDetails) {
                $bankDetails->delete();
            }
    
            // Delete the user
            $user->delete();
    
            $notification = [
                'message' => 'Teacher and associated bank details deleted successfully',
                'alert-type' => 'success',
            ];
    
            return redirect()->back()->with($notification);
        }
    
        $notification = [
            'message' => 'Teacher not found',
            'alert-type' => 'error',
        ];
    
        return redirect()->back()->with($notification);
    }
    

      public function Download(){

       // $editData = User::with('certificate')->find($id);
       // return $pdf->download('invoice.pdf');

     }// End Method 


}
