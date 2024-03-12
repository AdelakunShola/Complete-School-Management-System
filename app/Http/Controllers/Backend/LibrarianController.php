<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class LibrarianController extends Controller
{
    public function AllLibrarian(){
        $all_librarian = User::where('role', 'librarian')->latest()->get();
        return view('backend.librarian.all_librarian', compact('all_librarian'));
    }//end method


    public function AddLibrarian(){
        return view('backend.librarian.add_librarian');
    }//end method


    public function StoreLibrarian(Request $request) {

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



    public function EditLibrarian($id){
        $librarian = User::where('role', 'librarian')->find($id);
        return view('backend.librarian.edit_librarian', compact('librarian'));
    }//end method



    public function UpdateLibrarian($id){
       
    }//end method



    public function DeleteLibrarian($id){
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
    }//end method
}
