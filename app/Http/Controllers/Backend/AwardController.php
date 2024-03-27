<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AwardController extends Controller
{
    public function ManageAward(){
        $manage_award = Award::latest()->get();
        $employeeNamesByRole = User::whereIn('role', ['teacher', 'librarian', 'admin', 'accountant', 'hrm', 'hostelmanager', 'student'])
        ->orderBy('role')
        ->get()
        ->groupBy('role');
    
    return view('backend.manageaward.manage_award', compact('manage_award', 'employeeNamesByRole'));

    }//end method



    public function EditAward($id){
        $manageaward = Award::find($id);
        return response()->json($manageaward);
    }// End Method 
    


    public function StoreAward(Request $request){

        $a_number = IdGenerator::generate(['table' => 'awards','field' => 'award_code','length' => 6, 'prefix' => 'Ad' ]);

        Award::insert([
            'award_code' => $a_number,
            'name' => $request->name,
            'gift' => $request->gift,
            'amount' => $request->amount,
            'date' => $request->date,
            'employee_id' => $request->employee_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Award Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateAward(Request $request){

        $name_id = $request->id;
        
        Award::find($name_id)->update([
            'name' => $request->name,
            'gift' => $request->gift,
            'amount' => $request->amount,
            'date' => $request->date,
            'employee_id' => $request->employee_id,
        ]);
        $notification = array(
            'message' => 'Award Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteAward($id){
        Award::find($id)->delete();
        $notification = array(
            'message' => 'Award Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
