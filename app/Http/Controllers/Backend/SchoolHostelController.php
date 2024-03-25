<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HostelCategory;
use App\Models\HostelRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SchoolHostelController extends Controller
{




































////////////HOSTEL ROOM///////////////////////



public function HostelRoom(){
    $hostelroom = HostelRoom::latest()->get();
    return view('backend.schoolhostel.hostel_room',compact('hostelroom'));
}//end method


public function EditHostelRoom($id){
    $hostelroom = HostelRoom::find($id);
    return response()->json($hostelroom);
}// End Method 


public function StoreHostelRoom(Request $request){
    HostelRoom::insert([
        'name' => $request->name,
        'room_type' => $request->room_type,
        'no_of_bed' => $request->no_of_bed,
        'cost_per_bed' => $request->cost_per_bed,
        'description' => $request->description,
        'created_at' => Carbon::now(),
    ]);
    $notification = array(
        'message' => 'Hostel Room Added Successfully',
        'alert-type' => 'success',
    );
    return redirect()->back()->with($notification);
}// End Method 


public function UpdateHostelRoom(Request $request){
    $hostel_room_id = $request->hostel_room_id;
    HostelRoom::find($hostel_room_id)->update([
        'name' => $request->name,
        'room_type' => $request->room_type,
        'no_of_bed' => $request->no_of_bed,
        'cost_per_bed' => $request->cost_per_bed,
        'description' => $request->description,
    ]);
    $notification = array(
        'message' => 'Hostel Room Updated Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);


}// End Method  


public function DeleteHostelRoom($id){
    HostelRoom::find($id)->delete();
    $notification = array(
        'message' => 'Hostel Room Deleted Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);

}// End Method





















////////////HOSTEL CATEGORY///////////////////////



    public function HostelCategory(){
        $hostelcategory = HostelCategory::latest()->get();
        return view('backend.schoolhostel.hostel_category',compact('hostelcategory'));
    }//end method


    public function EditHostelCategory($id){
        $hostelcategory = HostelCategory::find($id);
        return response()->json($hostelcategory);
    }// End Method 


    public function StoreHostelCategory(Request $request){
        HostelCategory::insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Hostel Category Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateHostelCategory(Request $request){
        $hostel_category_id = $request->hostel_category_id;
        HostelCategory::find($hostel_category_id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $notification = array(
            'message' => 'Hostel Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteHostelCategory($id){
        HostelCategory::find($id)->delete();
        $notification = array(
            'message' => 'Hostel Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method
}
