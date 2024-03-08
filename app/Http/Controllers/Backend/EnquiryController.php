<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EnquiryCategory;
use App\Models\EnquiryList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function EnquiryCategory(){
        $enquiry_category = EnquiryCategory::latest()->get();
        return view('backend.enquiryCategory.enquiry_category',compact('enquiry_category'));
    }//end method


    public function EditEnquiryCategory($id){
        $enquirycategory = EnquiryCategory::find($id);
        return response()->json($enquirycategory);
    }// End Method 


    public function StoreEnquiryCategory(Request $request){
        EnquiryCategory::insert([
            'category' => $request->category,
            'purpose' => $request->purpose,
            'whom' => $request->whom,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Enquiry Category Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 



    public function UpdateEnquiryCategory(Request $request){
        $category_id = $request->category_id;
        EnquiryCategory::find($category_id)->update([
            'category' => $request->category,
            'purpose' => $request->purpose,
            'whom' => $request->whom,
        ]);
        $notification = array(
            'message' => 'Enquiry Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method 


    public function DeleteEnquiryCategory($id){
        EnquiryCategory::find($id)->delete();
        $notification = array(
            'message' => 'Enquiry Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 




    ///////ENQUIRY LIST ///////////////////////


    public function EnquiryList(){
        $enquiry_list = EnquiryList::latest()->get();
        return view('backend.enquiryList.enquiry_list',compact('enquiry_list'));
    }//end method


    public function DeleteEnquiryList($id){
        EnquiryList::find($id)->delete();
        $notification = array(
            'message' => 'Enquiry List Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function ViewEnquiryList($id){

        $enquirylist = EnquiryList::find($id);
        return response()->json($enquirylist);
    }// End Method 


}
