@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
    th {
    font-weight: normal;
}
    </style>


<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE VEHICLES</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">VEHICLES</li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<a href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD VEHICLE </a>
</div>
<div class="col-auto text-end float-end ms-auto download-grp">
<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
</div>
</div>
</div>

<div class="table-responsive">
<table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
<thead class="student-thread">
<tr>
<th>S/N</th>
<th>Name</th>
<th>Vehicle Number</th>
<th>Vehicle Model</th>
<th>Vehicle Quantity</th>
<th>Year Made</th>
<th>Driver Name</th>
<th>Driver Contact</th>
<th>status</th>
<th>Description</th>

<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($vehicle as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->name }}</td>
<th>{{$item->vehicle_number}}</th>
<th>{{$item->vehicle_model}}</th>
<th>{{$item->vehicle_quantity}}</th>
<th>{{$item->year_made}}</th>
<td>{{ $item->driver ? $item->driver->driver_name : 'N/A' }}</td>
<td>{{ $item->driver ? $item->driver->phone : 'N/A' }}</td>
<th>{{$item->status}}</th>
<td>{{ Str::limit($item->description, 55) }}</td>

<td class="text-end">
<div class="actions">
<button type="button" class="btn btn-sm text-success bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#con-close-modal" id="{{ $item->id }}" onclick="vehicle(this.id)"><i class="feather-edit"></i></button>


<a href="#" class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.vehicle', $item->id) }}')">
<i class="feather-trash"></i>
</a>


</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>




<!-- ADD VEHICLE --->

<div id="con-close-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<form method="post" action="{{ route('store.vehicle') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Vehicle</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Vehicle Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Vehicle Number</label>
<input type="text" class="form-control" id="vehicle_number" name="vehicle_number"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Vehicle Model</label>
<input type="text" class="form-control" id="vehicle_model" name="vehicle_model"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Vehicle Quantity</label>
<input type="text" class="form-control" id="vehicle_quantity" name="vehicle_quantity"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Year Made</label>
<input type="text" class="form-control" id="year_made" name="year_made"  >
</div>
</div>
</div>

<div class="form-group local-forms">
    <label>Select Class</label>
    <select class="form-control" name="driver_name" onchange="updateDriverContact(this)">
        <option value="">Select Driver Name</option>
        @foreach($drivers as $driver)
            <option value="{{ $driver->id }}" data-phone="{{ $driver->phone }}">{{ $driver->driver_name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group local-forms">
    <label>Driver Contact</label>
    <select class="form-control" name="driver_contact" id="driver_contact">
        
    </select>
</div>



<div class="col-md-12">
<div class>
<label for="field-7" class="form-label">DESCRIPTION</label>
<textarea class="form-control" id="description" name="description"></textarea>
</div>
</div>





</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
</div>
</div>
</form>
</div>
</div>




<!-- EDIT VEHICLE --->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<form method="post" action="{{ route('update.vehicle') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="vehicle_id" id="vehicle_id">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit Vehicle</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">
<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="edit-club_name" class="form-label">Vehicle Name</label>
<input type="text" class="form-control" id="edit-name" name="name">
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Vehicle Number</label>
<input type="text" class="form-control" id="edit-vehicle_number" name="vehicle_number"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Vehicle Model</label>
<input type="text" class="form-control" id="edit-vehicle_model" name="vehicle_model"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Vehicle Quantity</label>
<input type="text" class="form-control" id="edit-vehicle_quantity" name="vehicle_quantity"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Year Made</label>
<input type="text" class="form-control" id="edit-year_made" name="year_made"  >
</div>
</div>
</div>


<div class="form-group local-forms">
<label>Select Class</label>
<select class="form-control" name="driver_name" onchange="updateDriverContact(this)">
@foreach($drivers as $driver)
<option value="{{ $driver->id }}" data-phone="{{ $driver->phone }}">{{ $driver->driver_name }}</option>
@endforeach
</select>
</div>






<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="edit-status" class="form-label">Status</label>
<select class="form-select" id="edit-status" name="status">
<option value="active" {{ $item->status === 'active' ? 'selected' : '' }}>Active</option>
<option value="inactive" {{ $item->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
</select>
</div>
</div>
</div>


<div class="col-md-12">
<div class="mb-3">
<label for="edit-description" class="form-label">DESCRIPTION</label>
<textarea class="form-control" id="edit-description" name="description"></textarea>
</div>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
</div>
</div>
</form>
</div>
</div>



<script>
function vehicle(id){
$.ajax({
type: 'GET',
url: '/edit/vehicle/'+id,
dataType: 'json',

success:function(data){
// console.log(data)  
$('#edit-name').val(data.name);
$('#edit-vehicle_number').val(data.vehicle_number);
$('#edit-vehicle_model').val(data.vehicle_model);
$('#edit-vehicle_quantity').val(data.vehicle_quantity);
$('#edit-year_made').val(data.year_made);
$('#edit-driver_contact').val(data.driver_contact);
$('#edit-status').val(data.status);
$('#edit-description').val(data.description);
$('#vehicle_id').val(data.id);
}
});
}

</script>

<script>
    function updateDriverContact(select) {
        var selectedOption = select.options[select.selectedIndex];
        var driverContactInput = document.getElementById('driver_contact');
        
        // Clear previous options
        while (driverContactInput.options.length > 1) {
            driverContactInput.remove(1);
        }
        
        if (selectedOption.value !== '') {
            var driverContact = selectedOption.getAttribute('data-phone');
            var option = document.createElement('option');
            option.value = driverContact;
            option.text = driverContact;
            driverContactInput.add(option);
        }
    }
</script>


<script>
    function updateDriverContactEdit(select) {
        var selectedOption = select.options[select.selectedIndex];
        var driverContactInput = document.getElementById('driver_contact');
        
        // Update driver contact select dropdown
        driverContactInput.value = selectedOption.getAttribute('data-phone');
    }
</script>




@endsection