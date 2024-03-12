<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/hostelmanager/' . $name_gen; // Include the directory in the path
        Image::make($image)->resize(300, 300)->save($save_url);

       

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profession' => $request->profession,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'state' => $request->state,
            'country' => $request->country,
            'password' => Hash::make($request->input('password')),
            'photo' => $save_url,
            'role' => 'parent',
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Parent Data Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.hostelmanager')->with($notification);
    }



    public function EditHostelManager($id){
        $hostelmanager = User::where('role', 'hostelmanager')->find($id);
        return view('backend.hostelmanager.edit_hostelmanager', compact('hostelmanager'));
    }//end method



    public function UpdateHostelManager($id){
       
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
