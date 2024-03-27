<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function AllExpenseCategory(){
        $all_expense_category = ExpenseCategory::latest()->get();
        return view('backend.expensecategory.expense_category',compact('all_expense_category'));
    }//end method


    public function EditExpenseCategory($id){
        $expensecategory = ExpenseCategory::find($id);
        return response()->json($expensecategory);
    }// End Method 


    public function StoreExpenseCategory(Request $request){
        ExpenseCategory::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Expense Category Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.expense.category')->with($notification);
    }// End Method 


    public function UpdateExpenseCategory(Request $request){
        $name_id = $request->name_id;
        ExpenseCategory::find($name_id)->update([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Expense Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteExpenseCategory($id){
        ExpenseCategory::find($id)->delete();
        $notification = array(
            'message' => 'Expense Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
