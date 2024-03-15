<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SchoolLeave;
use Illuminate\Http\Request;

class SchoolLeaveController extends Controller
{
    public function SchoolLeave()
    {
        $school_leave = SchoolLeave::latest()->get();
        return view('backend.schoolleave.school_leave', compact('school_leave'));
    }

    public function EditSchoolLeave($id)
    {
        $schoolleave = SchoolLeave::find($id);
        return response()->json($schoolleave);
    }


    
    //public function StoreSchoolLeave(Request $request){
     //   SchoolLeave::insert([
      //      'club_name' => $request->club_name,
     //       'description' => $request->description,
     //       'created_at' => Carbon::now(),
     //   ]);
     //   $notification = array(
    //        'message' => 'School Leave Added Successfully',
    //        'alert-type' => 'success',
     //   );
     //   return redirect()->back()->with($notification);
   // }// End Method 


    public function UpdateSchoolLeave(Request $request)
    {
        $leave_id = $request->leave_id; // Corrected variable name
        $schoolLeave = SchoolLeave::find($leave_id);
        
        if ($schoolLeave) {
            $schoolLeave->update([
                'status' => $request->status,
            ]);
            
            $notification = [
                'message' => 'School Leave Updated Successfully',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'School Leave not found',
                'alert-type' => 'error'
            ];
        }

        return redirect()->back()->with($notification);
    }

    public function DeleteSchoolLeave($id)
    {
        SchoolLeave::find($id)->delete();
        $notification = [
            'message' => 'School Leave Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}

