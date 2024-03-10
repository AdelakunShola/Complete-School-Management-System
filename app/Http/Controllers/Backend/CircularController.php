<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Circular;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class CircularController extends Controller
{
    public function ManageCircular(){
        $circular = Circular::latest()->get();
        return view('backend.circular.manage_circular',compact('circular'));
    }//end method


    public function EditCircular($id){
        $circular = Circular::find($id);
        return response()->json($circular);
    }// End Method 

    


    public function StoreCircular(Request $request){

        $r_number = IdGenerator::generate(['table' => 'circulars','field' => 'reference_number','length' => 6, 'prefix' => 'CIR' ]);

        Circular::insert([
            'circular_title' => $request->circular_title,
            'reference_number' => $r_number,
            'content' => $request->content,
            'circular_date' => $request->circular_date,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Circular Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 




    public function UpdateCircular(Request $request){
        $circular_id = $request->circular_id;
        Circular::find($circular_id)->update([
            'circular_title' => $request->circular_title,
            'content' => $request->content,
            'circular_date' => $request->circular_date,
        ]);
        $notification = array(
            'message' => 'Circular Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method 


    public function DeleteCircular($id){
        Circular::find($id)->delete();
        $notification = array(
            'message' => 'Circular Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
