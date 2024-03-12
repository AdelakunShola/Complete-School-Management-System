<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Intervention\Image\Facades\Image;

class HostelManagerController extends Controller
{
    public function AllHostelManager(){
        $all_hostelmanager = User::where('role', 'hostelmanager')->latest()->get();
        return view('backend.hostelmanager.all_hostelmanager', compact('all_hostelmanager'));
    }//end method


    public function AddHostelManager(){
        return view('backend.hostelmanager.add_hostelmanager');
    }//end method


    public function StoreHostelManager(Request $request) {
        $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:users',
        
        ]);


        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'upload/hostelmanager/' . $name_gen;
            Image::make($image)->resize(300, 300)->save($save_url);
        

    
        // Generate hostelmanager ID
        $hostelmanager_number = IdGenerator::generate([
            'table' => 'users',
            'field' => 'hostelmanager_id',
            'length' => 7,
            'prefix' => 'HM'
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
    return redirect()->route('add.hostelmanager')->withErrors(['email' => 'This email is already in use. Please use another email.']);
} else {
    // Proceed with the insertion or update
        // Create a new hostel manager instance using dependency injection
        $hostelmanager = new User([
            'hostelmanager_id' => $hostelmanager_number,
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
            'role' => 'hostelmanager',
        ]);
    
        // Save the HostelManager instance to the database
        $hostelmanager->save();

    
        $notification = [
            'message' => 'Hostel Manager Data Inserted With Image Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.hostelmanager')->with($notification);

    }
}else{

// Generate HostelManager ID
$hostelmanager_number = IdGenerator::generate([
    'table' => 'users',
    'field' => 'hostelmanager_id',
    'length' => 7,
    'prefix' => 'HM'
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
return redirect()->route('add.hostelmanager')->withErrors(['email' => 'This email is already in use. Please use another email.']);
} else {
// Proceed with the insertion or update
// Create a new hostelmanager instance using dependency injection
$hostelmanager = new User([
    'hostelmanager_id' => $hostelmanager_number,
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
    'certificate' => $certificatePath,
    'nysc_certificate' => $nyscCertificatePath,
    'additional_document' => $additionalDocumentPath,
    'additional_document2' => $additionalDocument2Path,
    'role' => 'hostelmanager',
]);

// Save the hostelmanager instance to the database
$hostelmanager->save();


$notification = [
    'message' => 'Hostel Manager Data Inserted Without Image Successfully',
    'alert-type' => 'success',
];

return redirect()->route('all.hostelmanager')->with($notification);

}

}
    }//end method

 

    public function EditHostelManager($id){
        $hostelmanager = User::where('role', 'hostelmanager')->find($id);
        return view('backend.hostelmanager.edit_hostelmanager', compact('hostelmanager'));
    }//end method


    public function ViewHostelManager($id){
        $hostelmanager = User::where('role', 'hostelmanager')->findOrFail($id);
        return view('backend.hostelmanager.view_hostelmanager', compact('hostelmanager'));
    }//end method



    public function updateHostelManager(Request $request){

        $hostelmanager_id = $request->id;
        $data = User::findOrFail($hostelmanager_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $hostelmanager_id,
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
            'status' => 1,
        ]);
    
        // Check if a new photo has been uploaded
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/hostelmanager/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/hostelmanager'), $filename);
    
            // Update the photo field with the full path
            $data->update(['photo' => 'upload/hostelmanager/' . $filename]);
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
            'message' => 'Hostel Manager Profile Updated Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.hostelmanager')->with($notification);
    }//end method



    public function DeleteHostelManager($id){
        $user = User::find($id);

        // Check if the user exists
        if ($user) {
            // Delete the user's photo file
            @unlink(public_path('upload/hostelmanager/' . $user->photo));

            // Delete the user
            $user->delete();

            $notification = [
                'message' => 'Hostel Manager Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'Hostel Manager not found',
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }//end method
}
