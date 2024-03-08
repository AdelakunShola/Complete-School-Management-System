<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SchoolClub;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SchoolClubController extends Controller
{
    public function SchoolClub(){
        $school_club = SchoolClub::latest()->get();
        return view('backend.schoolClub.school_club',compact('school_club'));
    }//end method


    public function EditSchoolClub($id){
        $schoolclub = SchoolClub::find($id);
        return response()->json($schoolclub);
    }// End Method 


    public function StoreSchoolClub(Request $request){
        SchoolClub::insert([
            'club_name' => $request->club_name,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'School Club Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateSchoolClub(Request $request){
        $club_name_id = $request->club_name_id;
        SchoolClub::find($club_name_id)->update([
            'club_name' => $request->club_name,
            'description' => $request->description,
        ]);
        $notification = array(
            'message' => 'School Club Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method 


    public function DeleteSchoolClub($id){
        SchoolClub::find($id)->delete();
        $notification = array(
            'message' => 'School Club Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
