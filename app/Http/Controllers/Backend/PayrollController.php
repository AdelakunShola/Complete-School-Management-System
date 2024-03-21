<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Payroll;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function AllPayroll(){
        $departments = Department::latest()->get();
        $all_payroll = Payroll::latest()->get();
        $user = User::latest()->get();
        return view('backend.payroll.all_payroll', compact('all_payroll','departments','user'));
    }//end method


    public function AddPayroll(){
        $departments = Department::latest()->get();
        $users = User::latest()->get();
        return view('backend.payroll.add_payroll',compact('departments','users'));
    }//end method




    
    public function StorePayroll(Request $request){
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'month' => 'required',
            'year' => 'required',
            'status' => 'required|in:paid,unpaid',
            // Add more validation rules for other fields if needed
        ]);
    
        // Combine allowance types and amounts into an array
        $allowances = [];
        for ($i = 1; $i <= 4; $i++) {
            $allowanceType = $request->input("allowance_type$i");
            $allowanceAmount = $request->input("allowance_amount$i");
    
            if ($allowanceType && $allowanceAmount) {
                $allowances[] = ["type" => $allowanceType, "amount" => $allowanceAmount];
            }
        }
    
        // Combine deduction types and amounts into an array
        $deductions = [];
        for ($i = 1; $i <= 4; $i++) {
            $deductionType = $request->input("deduction_type$i");
            $deductionAmount = $request->input("deduction_amount$i");
    
            if ($deductionType && $deductionAmount) {
                $deductions[] = ["type" => $deductionType, "amount" => $deductionAmount];
            }
        }
    
        // Store data in the database
        Payroll::create([
            'user_id' => $request->user_id,
            'department_id' => $request->department_id,
            'month' => $request->month,
            'year' => $request->year,
            'status' => $request->status,
            'net_salary' => $request->net_salary,
            'allowances' => json_encode($allowances), // Encode allowances array as JSON
            'deductions' => json_encode($deductions), // Encode deductions array as JSON
            'total_allowance' =>  $request->total_allowance, 
            'total_deduction' =>  $request->total_deduction, 
            'tax_percentage' => $request->tax_percentage, // Store tax percentage
            'created_at' => Carbon::now(),
        ]);
    
        $notification = [
            'message' => 'Parent Data Inserted Successfully',
            'alert-type' => 'success',
        ];    
    
        // Redirect to a success page or return a response as needed
        return redirect()->route('all.payroll')->with($notification);
    }
    


    public function EditPayroll($id){
        $setting = Settings::find(1);
        $payroll_detail = Payroll::latest()->get();
        $payroll_data = Payroll::find($id);
        $departments = Department::all(); // Fetch all departments
        $users = User::all(); // Fetch all users
        return view('backend.payroll.edit_payroll', compact('setting', 'payroll_detail', 'payroll_data', 'departments', 'users'));
    }
    


    public function PayrollDetail($id){

        $setting = Settings::find(1);
        $payroll_detail = Payroll::latest()->get();
        $payroll_id = Payroll::find($id);
        return view('backend.payroll.payroll_detail',compact('setting','payroll_detail','payroll_id'));
    }//end method




    public function update(Request $request, $id) {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'month' => 'required',
            'year' => 'required',
            'status' => 'required|in:paid,unpaid',
            // Add more validation rules for other fields if needed
        ]);
    
        // Combine allowance types and amounts into an array
        $allowances = [];
        for ($i = 1; $i <= 4; $i++) {
            $allowanceType = $request->input("allowance_type$i");
            $allowanceAmount = $request->input("allowance_amount$i");
    
            if ($allowanceType && $allowanceAmount) {
                $allowances[] = ["type" => $allowanceType, "amount" => $allowanceAmount];
            }
        }
    
        // Combine deduction types and amounts into an array
        $deductions = [];
        for ($i = 1; $i <= 4; $i++) {
            $deductionType = $request->input("deduction_type$i");
            $deductionAmount = $request->input("deduction_amount$i");
    
            if ($deductionType && $deductionAmount) {
                $deductions[] = ["type" => $deductionType, "amount" => $deductionAmount];
            }
        }
    
        // Update data in the database
        $payroll = Payroll::findOrFail($id);
        $payroll->update([
            'user_id' => $request->user_id,
            'department_id' => $request->department_id,
            'month' => $request->month,
            'year' => $request->year,
            'status' => $request->status,
            'net_salary' => $request->net_salary,
            'allowances' => json_encode($allowances), // Encode allowances array as JSON
            'deductions' => json_encode($deductions), // Encode deductions array as JSON
            'total_allowance' =>  $request->total_allowance, 
            'total_deduction' =>  $request->total_deduction, 
            'tax_percentage' => $request->tax_percentage, // Store tax percentage
        ]);
    
        $notification = [
            'message' => 'Payroll Data Updated Successfully',
            'alert-type' => 'success',
        ];    
    
        // Redirect to a success page or return a response as needed
        return redirect()->route('all.payroll')->with($notification);
    }
    
    

    
    
//////end store payroll


public function MarkAsPaid(Request $request)
{
    $payroll_id = $request->id;
    $payroll = Payroll::findOrFail($payroll_id);
    
        $payroll->update([
            'status' => 'paid',
        ]);

        $notification = [
            'message' => 'Payment updated Inserted Successfully',
            'alert-type' => 'success',
        ]; 
    return redirect()->route('all.payroll')->with($notification);
}

public function MarkAsUnpaid(Request $request)
{
    $payroll_id = $request->id;
    $payroll = Payroll::findOrFail($payroll_id);
    
        $payroll->update([
            'status' => 'unpaid',
        ]);

        $notification = [
            'message' => 'Payment updated Inserted Successfully',
            'alert-type' => 'success',
        ]; 
    return redirect()->route('all.payroll')->with($notification);
}


    public function GetEmployeeName($department_id) {
    $users = User::where('department_id', $department_id)->orderBy('name','ASC')->get();
    return response()->json($users);
}


public function getSalary($user_id)
    {
        // Fetch the user by ID
        $user = User::find($user_id);

        if ($user) {
            // Return basic salary of the user
            return response()->json(['starting_salary' => $user->starting_salary]);
        } else {
            // If user not found, return an error message
            return response()->json(['error' => 'User not found'], 404);
        }
    }


 
}
