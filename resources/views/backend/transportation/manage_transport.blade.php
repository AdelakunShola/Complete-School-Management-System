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
<h3 class="page-title">MANAGE TRANSPORTS</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">TRANSPORTS</li>
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
<a href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD TRANSPORTS </a>
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
<th>Transport Route</th>
<th>Vehicle</th>
<th>Route Fare</th>
<th>Description</th>
<th>Status</th>

<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($transport as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->name }}</td>
<th>{{$item->transport_route_id}}</th>
<th>{{$item->vehicle_id}}</th>
<th>{{$item->route_fare}}</th>
<td>{{ Str::limit($item->description, 55) }}</td>
<th>{{$item->status}}</th>

<td class="text-end">
<div class="actions">
<button type="button" class="btn btn-sm text-success bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#con-close-modal" id="{{ $item->id }}" onclick="transport(this.id)"><i class="feather-edit"></i></button>


<a href="#" class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.transport', $item->id) }}')">
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




<!-- ADD Transport --->

<div id="con-close-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<form method="post" action="{{ route('store.transport') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Transport</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="form-group local-forms">
<label>Select Class</label>
<select class="form-control" name="transport_route_id" id="transport_route_id">
<option value="">Select Transport Route</option>
@foreach($transportroute as $troute)
<option value="{{ $troute->id }}" >{{ $troute->name }}</option>
@endforeach
</select>
</div>


<div class="form-group local-forms">
<label>Select Class</label>
<select class="form-control" name="vehicle_id" id="vehicle_id">
<option value="">Select Vehicle</option>
@foreach($vehicle as $veh)
<option value="{{ $veh->id }}">{{ $veh->name }}</option>
@endforeach
</select>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Route Fare</label>
<input type="text" class="form-control" id="route_fare" name="route_fare"  >
</div>
</div>
</div>


<div class="col-md-12">
<div class>
<label for="field-7" class="form-label">DESCRIPTION</label>
<textarea class="form-control" id="description" name="description"></textarea>
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




<!-- EDIT Transport --->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<form method="post" action="{{ route('update.transport') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="transport_id" id="transport_id">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit Transport</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Name</label>
<input type="text" class="form-control" id="edit-name" name="name"  >
</div>
</div>
</div>

<div class="form-group local-forms">
<label>Select Class</label>
<select class="form-control" name="transport_route_id" id="edit-transport_route_id">
<option value="">Select Transport Route</option>
@foreach($transportroute as $troute)
<option value="{{ $troute->id }}" >{{ $troute->name }}</option>
@endforeach
</select>
</div>


<div class="form-group local-forms">
<label>Select Class</label>
<select class="form-control" name="vehicle_id" id="edit-vehicle_id">
<option value="">Select Vehicle</option>
@foreach($vehicle as $veh)
<option value="{{ $veh->id }}">{{ $veh->name }}</option>
@endforeach
</select>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> Route Fare</label>
<input type="text" class="form-control" id="edit-route_fare" name="route_fare"  >
</div>
</div>
</div>


<div class="col-md-12">
<div class>
<label for="field-7" class="form-label">DESCRIPTION</label>
<textarea class="form-control" id="edit-description" name="description"></textarea>
</div>
</div>






<div class="col-md-6">
<div class="form-group">
<label>STATUS <span class="star-red">*</span></label>
<select id="edit-status" name="status" class="select form-control">
    <option selected disabled>Edit Status..</option>
    <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Active</option>
    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Inactive</option>
</select>
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
function transport(id){
$.ajax({
type: 'GET',
url: '/edit/transport/'+id,
dataType: 'json',

success:function(data){
// console.log(data)  
$('#edit-name').val(data.name);
$('#edit-transport_route_id').val(data.transport_route_id);
$('#edit-vehicle_id').val(data.vehicle_id);
$('#edit-route_fare').val(data.route_fare);
$('#edit-status').val(data.status);
$('#edit-description').val(data.description);
$('#transport_id').val(data.id);
}
});
}

</script>





@endsection