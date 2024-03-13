<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AlumniController extends Controller
{
    public function AllAlumni(){
        $all_alumni = Alumni::latest()->get();
        return view('backend.alumni.all_alumni', compact('all_alumni'));
    }

    public function AddAlumni(){
        return view('backend.alumni.add_alumni');
    }

    public function StoreAlumni(Request $request) {

        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/alumni/' . $name_gen; // Include the directory in the path
        Image::make($image)->resize(300, 300)->save($save_url);

       
 
        Alumni::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'graduation_year' => $request->graduation_year,
            'club' => $request->club,
            'interest' => $request->interest,
            'address' => $request->address,
            'state' => $request->state,
            'country' => $request->country,
            'photo' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Alumni Data Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.alumni')->with($notification);
    }

    public function EditAlumni($id){
        $alumni = Alumni::find($id);
        return view('backend.alumni.edit_alumni', compact('alumni'));
    }

    public function ViewAlumni($id){
        $alumni = Alumni::find($id);
        return view('backend.alumni.view_alumni', compact('alumni'));
    }


    public function UpdateAlumni(Request $request){
        $alumni_id = $request->id;
        $data = Alumni::findOrFail($alumni_id);
    
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'graduation_year' => $request->graduation_year,
            'club' => $request->club,
            'interest' => $request->interest,
            'address' => $request->address,
            'state' => $request->state,
            'country' => $request->country,
            'status' => 1,
        ]);
    
        // Check if a new photo has been uploaded
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/alumni/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/alumni'), $filename);
    
            // Update the photo field with the full path
            $data->update(['photo' => 'upload/alumni/' . $filename]);
        }
    
        $notification = [
            'message' => 'Alumni Profile Updated Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.alumni')->with($notification);
    }
    

 //   public function ParentUpdatePassword(Request $request){
        // Validation
    //    $request->validate([
    //        'old_password' => 'required',
      //      'new_password' => 'required|confirmed',
        //]);

        // Old password match
       // if (!Hash::check($request->old_password, auth()->user()->password)) {
         //   return back()->with("error", "Old Password Does Not Match!!!");
   //     }

        // Update new password
     //   User::whereId(auth()->user()->id)->update([
       //     'password' => Hash::make($request->new_password),
        //]);

        //$notification = [
          //  'message' => 'Password Updated Successfully',
            //'alert-type' => 'success',
      //  ];

        //return redirect()->back()->with($notification);
    //}

    

    public function DeleteAlumni($id){
        $user = Alumni::find($id);

        // Check if the user exists
        if ($user) {
            // Delete the user's photo file
            @unlink(public_path('upload/alumni/' . $user->photo));

            // Delete the user
            $user->delete();

            $notification = [
                'message' => 'Alumni Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'Alumni not found',
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }//end method
}
