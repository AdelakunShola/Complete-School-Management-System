<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class DepartmentController extends Controller
{

    public function AllDepartment(){

        $employeeNamesByRole = User::whereIn('role', ['teacher'])
        ->orderBy('role')
        ->get()
        ->groupBy('role');
        $department = Department::latest()->get();
        return view('backend.department.all_department',compact('department','employeeNamesByRole'));
    }//end method


    public function AddDepartment(){
        $employeeNamesByRole = User::whereIn('role', ['teacher'])
        ->orderBy('role')
        ->get()
        ->groupBy('role');
        $add_department = Department::latest()->get();
        return view('backend.department.add_department',compact('add_department','employeeNamesByRole'));

    } // End Method 


    public function StoreDepartment(Request $request)
{
    // Generate department number
    $department_number = IdGenerator::generate([
        'table' => 'departments',
        'field' => 'department_id',
        'length' => 9,
        'prefix' => 'DEPT'
    ]);

    // Store department
    $department = Department::create([
        'department_id' => $department_number,
        'name' => $request->name,
        'hod' => $request->hod,
        'year_started' => $request->year_started,
        'created_at' => Carbon::now(),
    ]);

    // Store designations (assuming there can be multiple designations)
    if ($request->has('designation_name')) {
        foreach ($request->designation_name as $designation_name) {
            Designation::create([
                'designation_name' => $designation_name,
                'department_id' => $department->id, // Assign department ID to the designation
                'created_at' => Carbon::now(),
            ]);
        }
    }

    // Redirect back with success message
    $notification = [
        'message' => 'Department and Designations added successfully',
        'alert-type' => 'success',
    ];
    return redirect()->route('all.department')->with($notification);
    }// End Method 



    public function EditDepartment($id){

        $employeeNamesByRole = User::whereIn('role', ['teacher'])
        ->orderBy('role')
        ->get()
        ->groupBy('role');

        $designation = Designation::where('department_id',$id)->get();
        $department = Department::find($id);
        return view('backend.department.edit_department',compact('department','designation','employeeNamesByRole'));
    } //End Method 


    public function UpdateDepartment(Request $request, $id) {
        $department = Department::find($id);
        
        // Update department details
        $department->update([
            'name' => $request->name,
            'hod' => $request->hod,
            'year_started' => $request->year_started,
        ]);
    
        // Handle Designations Update
        if ($request->has('designation_name')) {
            foreach ($request->designation_name as $designation_name) {
                // Check if the designation already exists
                $existingDesignation = Designation::where('department_id', $id)
                    ->where('designation_name', $designation_name)
                    ->first();
    
                // If the designation does not exist, create a new one
                if (!$existingDesignation) {
                    Designation::create([
                        'department_id' => $id,
                        'designation_name' => $designation_name,
                    ]);
                }
            }
        }
    
        $notification = [
            'message' => 'Department Updated Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('all.department')->with($notification);
    }// End Method



    public function DeleteDepartment($id){
        // Find the department
        $department = Department::find($id);
    
        // Delete all designations associated with the department
        $department->designations()->delete();
    
        // Delete the department
        $department->delete();
    
        $notification = array(
            'message' => 'Department and associated designations deleted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }/// End Method






    public function GetDesignation($department_id){
        $subcat = Designation::where('department_id',$department_id)->orderBy('designation_name','ASC')->get();
            return json_encode($subcat);

    }// End Method 

    
    

}
