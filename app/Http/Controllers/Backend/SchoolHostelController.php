<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HostelCategory;
use App\Models\HostelRoom;
use App\Models\SchoolHostel;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SchoolHostelController extends Controller
{



    ////////////MANAGE HOSTEL///////////////////////



public function AllHostel(){
    $allhostel = SchoolHostel::latest()->get();
    return view('backend.schoolhostel.all_hostel',compact('allhostel'));
}//end method


public function AddHostel(){
    $hostelcategory = HostelCategory::latest()->get();
    $hostelroom = HostelRoom::latest()->get();
    return view('backend.schoolhostel.add_hostel',compact('hostelcategory', 'hostelroom'));
}//end method


public function StoreHostel(Request $request){
    $save_url = null;
    $image = $request->file('photo');

    // Check if a file was uploaded
    if ($image) {
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/hostel/' . $name_gen; // Include the directory in the path
        Image::make($image)->resize(300, 300)->save($save_url);
    }

    SchoolHostel::insert([
        'name' => $request->name,
        'hostel_room_id' => $request->hostel_room_id,
        'hostel_category_id' => $request->hostel_category_id,
        'capacity' => $request->capacity,
        'address' => $request->address,
        'description' => $request->description,
        'photo' => $save_url,
        'created_at' => Carbon::now(),
    ]);

    $notification = array(
        'message' => 'Hostel Details Added Successfully',
        'alert-type' => 'success',
    );
    return redirect()->route('all.hostel')->with($notification);
}


public function EditHostel($id){
    $edithostel = SchoolHostel::find($id);
    $hostelcategory = HostelCategory::latest()->get();
    $hostelroom = HostelRoom::latest()->get();
    return view('backend.schoolhostel.edit_hostel',compact('edithostel', 'hostelcategory', 'hostelroom'));
}// End Method 

public function ViewHostel($id){
    $edithostel = SchoolHostel::find($id);
    $hostelcategory = HostelCategory::latest()->get();
    $hostelroom = HostelRoom::latest()->get();
    return view('backend.schoolhostel.view_hostel',compact('edithostel', 'hostelcategory', 'hostelroom'));
}// End Method 



public function UpdateHostel(Request $request){
        $hostel_id = $request->id;
        $data = SchoolHostel::findOrFail($hostel_id);
    
        $data->update([
        'name' => $request->name,
        'hostel_room_id' => $request->hostel_room_id,
        'hostel_category_id' => $request->hostel_category_id,
        'capacity' => $request->capacity,
        'address' => $request->address,
        'description' => $request->description,
    ]);

    // Check if a new photo has been uploaded
    if ($request->file('photo')) {
        $file = $request->file('photo');
        @unlink(public_path('upload/parent/' . $data->photo));
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('upload/parent'), $filename);

        // Update the photo field with the full path
        $data->update(['photo' => 'upload/parent/' . $filename]);
    }

    $notification = array(
        'message' => 'Hostel Details Updated Successfully',
        'alert-type' => 'success'
    );
    return redirect()->route('all.hostel')->with($notification);


}// End Method  


public function DeleteHostel($id){
    SchoolHostel::find($id)->delete();
    $notification = array(
        'message' => 'Hostel Details Deleted Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);

}// End Method











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
