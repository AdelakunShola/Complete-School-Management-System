<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function AllExpense(Request $request){
        $expense = Expense::latest()->get();
        return view('backend.expense.all_expense',compact('expense'));
    }//end method


    public function AddExpense(){
        $category = ExpenseCategory::latest()->get();
        return view('backend.expense.add_expense', compact('category'));
    }//end method


    public function StoreExpense(Request $request){

        $expense_number = IdGenerator::generate(['table' => 'expenses','field' => 'expense_id','length' => 7, 'prefix' => 'EXP' ]);
   
    Expense::insert([
         
        'expense_id' => $expense_number,
        'category_id' => $request->category_id,
        'invoice_id' => $request->invoice_id,
        'student_id' => $request->student_id,

        'item_name' => $request->item_name,
        'payment_type' => $request->payment_type,
        'method' => $request->method,
        'description' => $request->description,
        'amount' => $request->amount,

        'quantity' => $request->quantity,
        'discount' => $request->discount,
        'purchase_date' => $request->purchase_date,
        'purchase_by' => $request->purchase_by, 

        'created_at' => Carbon::now(), 
        

    ]);

    $notification = array(
        'message' => 'Expense Inserted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('all.expense')->with($notification); 


}// End Method 


    public function EditExpense($id){
        $category = ExpenseCategory::latest()->get();
        $editData = Expense::find($id);
         return view('backend.expense.edit_expense',compact('category','editData'));
     }// End Method 


     public function ViewExpense($id){
        $category = ExpenseCategory::latest()->get();
         return view('backend.expense.view_expense',compact('category'));
     }// End Method 


     public function UpdateExpense(Request $request){
        $expense_id = $request->id;
        Expense::find($expense_id)->update([

        'category_id' => $request->category_id,
        'invoice_id' => $request->invoice_id,
        'student_id' => $request->student_id,

        'item_name' => $request->item_name,
        'payment_type' => $request->payment_type,
        'method' => $request->method,
        'description' => $request->description,
        'amount' => $request->amount,

        'quantity' => $request->quantity,
        'discount' => $request->discount,
        'purchase_date' => $request->purchase_date,
        'purchase_by' => $request->purchase_by, 

        ]);
        $notification = array(
            'message' => 'Expense Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.expense')->with($notification); 


    }// End Method 



     public function DeleteExpense($id){
        Expense::find($id)->delete();
        $notification = array(
            'message' => 'Expense Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
