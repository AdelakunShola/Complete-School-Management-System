<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\SchoolSubject;
use App\Models\Settings;
use App\Models\Syllabus;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Storage;

class SyllabusController extends Controller
{
    
    public function AllSyllabus(){
        $all_syllabus = Syllabus::latest()->get();
        return view('backend.syllabus.all_syllabus', compact('all_syllabus'));
    }//end method


    public function AddSyllabus(){
        $classes = Classes::latest()->get();
        $subject = SchoolSubject::latest()->get();
        $setting = Settings::find(1);
        return view('backend.syllabus.add_syllabus', compact('classes', 'subject','setting'));
    }//end method



    public function StoreSyllabus(Request $request){
        // Generate HRM ID
        $syllabus_number = IdGenerator::generate([
            'table' => 'syllabi',
            'field' => 'academic_syllabus_code',
            'length' => 7,
            'prefix' => 'SYL'
        ]);

        $filePaths = [];
        if ($request->hasFile('file_name')) {
            foreach ($request->file('file_name') as $file) {
                $path = $file->store('upload/syllabus', 'public');
                $filePaths[] = $path;
            }
        }

        Syllabus::insert([
            'academic_syllabus_code' => $syllabus_number,
            'title' => $request->title,
            'class_id' => $request->class_id,
            'subjects_id' => $request->subjects_id,
            'uploaded_by' => auth()->user()->role . ' ' . auth()->user()->name,
            'session' => $request->session,
            'description' => $request->description,
            'file_name' => implode(',', $filePaths),
            'created_at' => Carbon::now(),     
            
        ]);

        $notification = [
            'message' => 'Syllabus Data Inserted Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.syllabus')->with($notification);
    }//end method


    public function EditSyllabus($id){
        $editSyllabus = Syllabus::findOrFail($id);
        $classes = Classes::latest()->get();
        $subject = SchoolSubject::latest()->get();
        $setting = Settings::find(1);
        return view('backend.syllabus.edit_syllabus', compact('classes', 'subject','setting','editSyllabus'));
    }//end method




    public function UpdateSyllabus(Request $request) {
        
        $syllabus_id = $request->id;
        $syllabus = Syllabus::findOrFail($syllabus_id);

        $syllabus->update([
            'title' => $request->title,
            'class_id' => $request->class_id,
            'subjects_id' => $request->subjects_id,
            'uploaded_by' => auth()->user()->role . ' ' . auth()->user()->name,
            'session' => $request->session,
            'description' => $request->description,
        ]);
    
        // Handle file uploads
        $filePaths = [];
        if ($request->hasFile('file_name')) {
            foreach ($request->file('file_name') as $file) {
                $path = $file->store('upload/syllabus', 'public');
                $filePaths[] = $path;
            }
        }
    
        // If new files are uploaded, update the file_name attribute
        if (!empty($filePaths)) {
            $syllabus->file_name = implode(',', $filePaths);
        }
    
        // Save the updated syllabus entry
        $syllabus->save();
    
        // Prepare notification message
        $notification = [
            'message' => 'Syllabus Data Updated Successfully',
            'alert-type' => 'success',
        ];
    
        // Redirect back to the syllabus list page
        return redirect()->route('all.syllabus')->with($notification);
    }


    public function ViewSyllabus($id){
        $editSyllabus = Syllabus::findOrFail($id);
        $classes = Classes::latest()->get();
        $subject = SchoolSubject::latest()->get();
        $setting = Settings::find(1);
        return view('backend.syllabus.view_syllabus', compact('classes', 'subject','setting','editSyllabus'));
    }//end method





    public function DeleteSyllabus($id) {
        // Find the syllabus entry to delete
        $syllabus = Syllabus::findOrFail($id);
    
        // Unlink associated files from storage
        $filePaths = explode(',', $syllabus->file_name);
        foreach ($filePaths as $filePath) {
            Storage::disk('public')->delete($filePath);
        }
    
        // Delete the syllabus entry
        $syllabus->delete();
    
        // Prepare notification message
        $notification = [
            'message' => 'Syllabus Data Deleted Successfully',
            'alert-type' => 'success',
        ];
    
        // Redirect back to the syllabus list page
        return redirect()->route('all.syllabus')->with($notification);
    }
    

}
