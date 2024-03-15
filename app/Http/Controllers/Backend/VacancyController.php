<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function ManageVacancy(){
        $vacancies = Vacancy::latest()->get();
        return view('backend.vacancies.manage_vacancy',compact('vacancies'));
    }//end method


    public function EditVacancy($id){
        $vacancy = Vacancy::find($id);
        return response()->json($vacancy);
    }// End Method 


    public function StoreVacancy(Request $request){
        Vacancy::insert([

            'name' => $request->name,
            'number_of_vacancy' => $request->number_of_vacancy,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Vacancy Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateVacancy(Request $request){
        $vacancy_id = $request->id;
        Vacancy::find($vacancy_id)->update([
            'name' => $request->name,
            'number_of_vacancy' => $request->number_of_vacancy,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'Vacancy Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteVacancy($id){
        Vacancy::find($id)->delete();
        $notification = array(
            'message' => 'Vacancy Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method
}
