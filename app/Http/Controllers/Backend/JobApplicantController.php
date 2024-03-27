<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JobApplicant;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 
class JobApplicantController extends Controller
{
    public function AllApplication(Request $request){
        $status = $request->input('status');
        $allapplications = JobApplicant::where('status', $status)->get();
        return view('backend.jobapplications.allapplication',compact('allapplications','status'));
    }//end method


    public function AddApplication(){
        $applicant = JobApplicant::latest()->get();
        $vacancy = Vacancy::latest()->get();
        return view('backend.jobapplications.addapplication',compact('vacancy','applicant'));
    }//end method




public function StoreApplication(Request $request){
    // Define upload paths for CV and cover letter
    $cvUploadPath = 'upload/applicant/cv';
    $coverLetterUploadPath = 'upload/applicant/cover_letter';

    // Handle cover letter upload
    $coverLetterPath = null;
    if ($request->hasFile('cover_letter')) {
        $coverLetterPath = $request->file('cover_letter')->storeAs(
            $coverLetterUploadPath,
            'cover_letter_' . uniqid() . '.' . $request->file('cover_letter')->getClientOriginalExtension(),
            'public' // Specify the disk as 'public'
        );
    }
    
    // Handle cv upload
    $cvPath = null;
    if ($request->hasFile('cv')) {
        $cvPath = $request->file('cv')->storeAs(
            $cvUploadPath,
            'cv_' . uniqid() . '.' . $request->file('cv')->getClientOriginalExtension(),
            'public' // Specify the disk as 'public'
        );
    }

    // Create new JobApplicant instance
    $application = new JobApplicant([
        'vacancy_id' => $request->input('vacancy_id'),
        'applicant_name' => $request->input('applicant_name'),
        'email' => $request->input('email'),
        'cv' => $cvPath,
        'cover_letter' => $coverLetterPath,
    ]);
    
    // Save the JobApplicant instance to the database
    $application->save();
    
    // Redirect with success message
    $notification = [
        'message' => 'Your information has been inserted successfully.',
        'alert-type' => 'success',
    ];
    
    return redirect()->route('all.application')->with($notification);
}



    public function ViewApplication($id){
        $applicant = JobApplicant::find($id);
        $vacancy = Vacancy::latest()->get();
        return view('backend.jobapplications.viewapplication',compact('vacancy','applicant'));
    }//end method



    public function UpdateApplication(Request $request){
     
        $applicant_id = $request->id;
        $applicant = JobApplicant::findOrFail($applicant_id);

        $applicant->update([
            'status' => $request->status,
        ]);

    // Redirect with success message
    $notification = [
        'message' => 'Applicant Status Updated successfully.',
        'alert-type' => 'success',
    ];
    
    return redirect()->route('all.application')->with($notification);

    }//end method


    public function EditApplication($id){
        $applicant = JobApplicant::find($id);
        $vacancy = Vacancy::latest()->get();
        return view('backend.jobapplications.viewapplication',compact('vacancy','applicant'));
    }//end method



    public function Deleteapplication($id){
        $applicant = JobApplicant::find($id);

        // Check if the user exists
        if ($applicant) {
            // Delete the user's photo file
            @unlink(public_path('upload/application/' . $applicant->cv));
            @unlink(public_path('upload/application/' . $applicant->cover_letter));

            // Delete the user
            $applicant->delete();

            $notification = [
                'message' => 'Applicant details Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'Applicant details not found',
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }//end method



    public function Download(){

        // $editData = User::with('certificate')->find($id);
        // return $pdf->download('invoice.pdf');
 
      }// End Method 



    



    // Method to download cover letter
  //  public function downloadCoverLetter($id)
 //   {
 //       $application = JobApplicant::findOrFail($id);
//        $coverLetterPath = storage_path('' . $application->cover_letter);
 //       return response()->download($coverLetterPath, $application->cover_letter_name);
 //   }
    
 //   public function downloadCV($id)
 //   {
//        $application = JobApplicant::findOrFail($id);
//        $cvPath = storage_path('' . $application->cv);
//        return response()->download($cvPath, $application->cv_name);
//    }
    



}
   

