<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\TransportRoute;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TransportationController extends Controller
{
    










     ////////////Transport Route////////


     public function TransportRoute(){
        $transportroute = TransportRoute::latest()->get();
        return view('backend.transportation.transport_route',compact('transportroute'));
    }//end method


    public function EditTransportRoute($id){
        $transportroute = TransportRoute::find($id);
        return response()->json($transportroute);
    }// End Method 


    public function StoreTransportRoute(Request $request){
        TransportRoute::insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Transport Route Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateTransportRoute(Request $request){
        $transportroute_id = $request->transportroute_id;
        TransportRoute::find($transportroute_id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $notification = array(
            'message' => 'Transport Route Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteTransportRoute($id){
        TransportRoute::find($id)->delete();
        $notification = array(
            'message' => 'Transport Route Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 












     ////////////VEHICLE ROUTE////////


     public function ManageVehicle(){
        $vehicle = Vehicle::latest()->get();
        $driver = Driver::latest()->get();
        $drivers = Driver::latest()->get();
        return view('backend.transportation.manage_vehicle',compact('vehicle','driver','drivers'));
    }//end method


    public function EditVehicle($id){
        $vehicle = Vehicle::find($id);
        return response()->json($vehicle);
    }// End Method 


    public function StoreVehicle(Request $request){
        Vehicle::insert([
            'name' => $request->name,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_model' => $request->vehicle_model,
            'vehicle_quantity' => $request->vehicle_quantity,
            'year_made' => $request->year_made,
            'driver_name' => $request->driver_name,
            'driver_contact' => $request->driver_contact,
            'status' => $request->status,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Vehicle Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


    public function UpdateVehicle(Request $request){
        $vehicle_id = $request->vehicle_id;
        Vehicle::find($vehicle_id)->update([
            'name' => $request->name,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_model' => $request->vehicle_model,
            'vehicle_quantity' => $request->vehicle_quantity,
            'year_made' => $request->year_made,
            'driver_name' => $request->driver_name,
            'driver_contact' => $request->driver_contact,
            'status' => $request->status,
            'description' => $request->description,
        ]);
        $notification = array(
            'message' => 'Vehicle Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method  


    public function DeleteVehicle($id){
        Vehicle::find($id)->delete();
        $notification = array(
            'message' => 'Vehicle Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 













    ////////////DRIVER ROUTE////////


    public function ManageDriver(){
        $driver = Driver::latest()->get();
        return view('backend.transportation.manage_driver',compact('driver'));
    }//end method


    public function EditDriver($id){
       
        $driver = Driver::find($id);
        return view('backend.transportation.edit_driver',compact('driver'));
    }// End Method 


    public function StoreDriver(Request $request){


        $save_url = null;
        if ($request->file('guarantor_id_card')) {
            $image = $request->file('guarantor_id_card');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'upload/license/' . $name_gen;
            Image::make($image)->resize(300, 300)->save($save_url);
        }


        $save_url = null;
        if ($request->file('license')) {
            $image = $request->file('license');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'upload/license/' . $name_gen;
            Image::make($image)->resize(300, 300)->save($save_url);
        }



        Driver::insert([
            'driver_name' => $request->driver_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'license_number' => $request->license_number,
            'license_expiry_date' => $request->license_expiry_date,

            'guarantor_name' => $request->guarantor_name,
            'guarantor_phone' => $request->guarantor_phone,
            'guarantor_address' => $request->guarantor_address,
            'status' => $request->status,

            'guarantor_id_card' => $save_url,
            'license' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Driver Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }// End Method 


     public function UpdateDriver(Request $request){

       

    $driver_id = $request->id;
    $driver = Driver::findOrFail($driver_id); // Fetch the correct driver instance

    $driver->update([
        'driver_name' => $request->driver_name,
        'phone' => $request->phone,
        'address' => $request->address,
        'license_number' => $request->license_number,
        'license_expiry_date' => $request->license_expiry_date,
        'guarantor_name' => $request->guarantor_name,
        'guarantor_phone' => $request->guarantor_phone,
        'guarantor_address' => $request->guarantor_address,
        'status' => $request->status,
    ]);

    // Check if a new license has been uploaded
    if ($request->hasFile('license')) {
        $file = $request->file('license');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload/license'), $filename);
        $driver->license = 'upload/license/' . $filename; // Update the license property
    }

    // Check if a new guarantor ID card has been uploaded
    if ($request->hasFile('guarantor_id_card')) {
        $file = $request->file('guarantor_id_card');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload/license'), $filename);
        $driver->guarantor_id_card = 'upload/license/' . $filename; // Update the guarantor_id_card property
    }

    $driver->save();

    $notification = array(
        'message' => 'Driver Updated Successfully',
        'alert-type' => 'success'
    );
    return redirect()->route('manage.driver')->with($notification);
}



    public function DeleteDriver($id){
        Driver::find($id)->delete();
        $notification = array(
            'message' => 'Driver Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method 
}
