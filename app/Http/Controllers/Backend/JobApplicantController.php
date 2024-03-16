<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JobApplicant;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobApplicantController extends Controller
{
    public function AllApplication(){
        $allapplications = JobApplicant::latest()->get();
        return view('backend.jobapplications.allapplication',compact('allapplications'));
    }//end method


    public function AddApplication(){
        $applicant = JobApplicant::latest()->get();
        $vacancy = Vacancy::latest()->get();
        return view('backend.jobapplications.addapplication',compact('vacancy','applicant'));
    }//end method



    public function StoreApplication(Request $request){
    // For documents, use different upload paths
    $cvUploadPath = 'application';
    $coverLetterUploadPath = 'application';

    
    $cvPath = $request->file('cv') ? $request->file('cv')
    ->storeAs($cvUploadPath, 'cv_' . uniqid() . '.' . $request
    ->file('cv')->getClientOriginalExtension()) : null;
    
    $coverLetterPath = $request->file('cover_letter') ? $request->file('cover_letter')
    ->storeAs($coverLetterUploadPath, 'cover_letter_' . uniqid() . '.' . $request
    ->file('cover_letter')->getClientOriginalExtension()) : null;
       
    // Now you can use these variables in your User creation
    
    

    $application = new JobApplicant([
     
        'vacancy_id' => $request->input('vacancy_id'),
        'applicant_name' => $request->input('applicant_name'),
        'email' => $request->input('email'),
        'cv' => $cvPath,
        'cover_letter' => $coverLetterPath,

    ]);
    
    // Save the HRM instance to the database
    $application->save();
    
    
    $notification = [
        'message' => 'Your Information has been Inserted Successfully',
        'alert-type' => 'success',
    ];
    
    return redirect()->route('all.application')->with($notification);
    

    
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



    public function ViewApplication(){
        $vacancy = Vacancy::latest()->get();
        return view('backend.jobapplications.viewapplication',compact('vacancy'));
    }//end method


    public function Editpplication(){
        $vacancy = Vacancy::latest()->get();
        return view('backend.jobapplications.editapplication',compact('vacancy'));
    }//end method



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
   

