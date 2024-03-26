<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TransportRoute;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        return view('backend.transportation.manage_vehicle',compact('vehicle'));
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
}
