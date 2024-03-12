<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HRM;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;


class HRMController extends Controller
{
    public function AllHrm(){
        $all_hrm = User::where('role', 'hrm')->latest()->get();
        return view('backend.hrm.all_hrm', compact('all_hrm'));
    }//end method


    public function AddHrm(){
        return view('backend.hrm.add_hrm');
    }//end method


    public function StoreHrm(Request $request) {
        //$request->validate([
          //  'name' => 'required|string|max:255',
          //  'email' => 'required|email|unique:hrms',
          //  'gender' => 'required|string|max:255',
          //  'dob' => 'required|date',
            // Add more specific validation rules as needed
        //]);
    
        // Generate HRM ID
        $hrm_number = IdGenerator::generate([
            'table' => 'users',
            'field' => 'hrm_id',
            'length' => 10,
            'prefix' => 'HRM'
        ]);
    
        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/hrm/' . $name_gen; // Include the directory in the path
        Image::make($image)->resize(300, 300)->save($save_url);

// For documents, use a common upload path
$documentUploadPath = 'public';

$certificatePath = $request->file('certificate')->storeAs($documentUploadPath, 'certificate_' . uniqid() . '.' . $request->file('certificate')->getClientOriginalExtension() );

$nyscCertificatePath = $request->file('nysc_certificate')->storeAs($documentUploadPath, 'nysc_certificate_' . uniqid() . '.' . $request->file('nysc_certificate')->getClientOriginalExtension());

$additionalDocumentPath = $request->file('additional_document')->storeAs($documentUploadPath, 'additional_document_' . uniqid() . '.' . $request->file('additional_document')->getClientOriginalExtension());

$additionalDocument2Path = $request->file('additional_document2')->storeAs($documentUploadPath, 'additional_document2_' . uniqid() . '.' . $request->file('additional_document2')->getClientOriginalExtension());

//dd($certificatePath, $nyscCertificatePath, $additionalDocumentPath, $additionalDocument2Path);

        // Create a new HRM instance using dependency injection
        $hrm = new User([
            'hrm_id' => $hrm_number,
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
            'photo' => $save_url,
            'certificate' => $certificatePath,
            'nysc_certificate' => $nyscCertificatePath,
            'additional_document' => $additionalDocumentPath,
            'additional_document2' => $additionalDocument2Path,
            'role' => 'hrm',
        ]);
    
        // Save the HRM instance to the database
        $hrm->save();
    
        $notification = [
            'message' => 'HRM Data Inserted Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.hrm')->with($notification);
    }//end method
    



    public function EditHrm($id){
        $hrm = User::where('role', 'hrm')->findOrFail($id);
        return view('backend.hrm.edit_hrm', compact('hrm'));
    }//end method







        //$this->updateFile($request, $hrm, 'certificate', $documentUploadPath);
        //$this->updateFile($request, $hrm, 'nysc_certificate', $documentUploadPath);
        //$this->updateFile($request, $hrm, 'additional_document', $documentUploadPath);
        //$this->updateFile($request, $hrm, 'additional_document2', $documentUploadPath);

    
     public function updateHrm(Request $request){
        $hrm_id = $request->id;
        $data = User::findOrFail($hrm_id);
    
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
            'status' => 1,
        ]);
    
        // Check if a new photo has been uploaded
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/hrm/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/hrm'), $filename);
    
            // Update the photo field with the full path
            $data->update(['photo' => 'upload/hrm/' . $filename]);
        }



        // Check if a new certificate has been uploaded
        if ($request->file('certificate')) {
            $file = $request->file('certificate');
            @unlink(public_path('public/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public'), $filename);
    
            // Update the photo field with the full path
            $data->update(['certificate' => 'public/' . $filename]);
        }





    
        $notification = [
            'message' => 'HRM Profile Updated Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.hrm')->with($notification);
    }//end method




   




    public function DeleteHrm($id){
        $user = User::find($id);

        // Check if the user exists
        if ($user) {
            // Delete the user's photo file
            @unlink(public_path('upload/hrm/' . $user->photo));

            // Delete the user
            $user->delete();

            $notification = [
                'message' => 'HRM Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'HRM not found',
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }//end method



      public function Download(){

       // $editData = User::with('certificate')->find($id);
       // return $pdf->download('invoice.pdf');

     }// End Method 


}
