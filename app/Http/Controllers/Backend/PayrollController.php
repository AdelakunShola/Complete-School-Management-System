<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
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
    
        // Process allowances and deductions
        $allowances = [];
        foreach ($request->allowance_type as $key => $type) {
            if (!empty($type) && !empty($request->allowance_amount[$key])) {
                // Append allowance to the array
                $allowances[] = [
                    'type' => $type,
                    'amount' => $request->allowance_amount[$key]
                ];
            }
        }

        
    
    
        $deductions = [];
        foreach ($request->deduction_type as $key => $type) {
            if (!empty($type) && !empty($request->deduction_amount[$key])) {
                // Append deduction to the array
                $deductions[] = [
                    'type' => $type,
                    'amount' => $request->deduction_amount[$key]
                ];
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
            'allowances' => json_encode($allowances), // Store allowances as JSON
            'deductions' => json_encode($deductions), // Store deductions as JSON
            'created_at' => Carbon::now(),
        ]);
    
        $notification = [
            'message' => 'Parent Data Inserted Successfully',
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
