<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AccountantController extends Controller
{
    public function AllAccountant(){
        $all_accountant = User::where('role', 'accountant')->latest()->get();
        return view('backend.accountant.all_accountant', compact('all_accountant'));
    }//end method


    public function AddAccountant(){
        return view('backend.accountant.add_accountant');
    }//end method


    public function StoreAccountant(Request $request) {

        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/accountant/' . $name_gen; // Include the directory in the path
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
            'message' => 'Accountant Data Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.accountant')->with($notification);
    }



    public function EditAccountant($id){
        $accountant = User::where('role', 'accountant')->find($id);
        return view('backend.accountant.edit_accountant', compact('accountant'));
    }//end method



    public function UpdateAccountant($id){
       
    }//end method



    public function DeleteAccountant($id){
        $user = User::find($id);

        // Check if the user exists
        if ($user) {
            // Delete the user's photo file
            @unlink(public_path('upload/accountant/' . $user->photo));

            // Delete the user
            $user->delete();

            $notification = [
                'message' => 'Accountant Data Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'Accountant not found',
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }//end method
}
