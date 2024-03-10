<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ParentController extends Controller
{
    public function AllParent()
    {
        $all_parent = User::where('role', 'parent')->latest()->get();
        return view('backend.manageparent.all_parent', compact('all_parent'));
    }

    public function AddParent()
    {
        return view('backend.manageparent.add_parent');
    }

    public function StoreParent(Request $request) {

        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/parent/' . $name_gen; // Include the directory in the path
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

        return redirect()->route('all.parent')->with($notification);
    }

    public function EditParent($id){
        $parent = User::find($id);
        return view('backend.manageparent.edit_parent', compact('parent'));
    }

    public function UpdateParent(Request $request){
        $parent_id = $request->id;
        $data = User::findOrFail($parent_id);
    
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'profession' => $request->profession,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'state' => $request->state,
            'country' => $request->country,
            'status' => 1,
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
    
        $notification = [
            'message' => 'Parent Profile Updated Successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->back()->with($notification);
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

    

    public function DeleteParent($id)
    {
        $user = User::find($id);

        // Check if the user exists
        if ($user) {
            // Delete the user's photo file
            @unlink(public_path('upload/parent/' . $user->photo));

            // Delete the user
            $user->delete();

            $notification = [
                'message' => 'Parent Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'Parent not found',
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
}
