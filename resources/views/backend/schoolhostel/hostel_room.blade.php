@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE HOSTEL ROOM</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">HOSTEL ROOM</li>
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
<a href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD HOSTEL ROOM </a>
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
<th>Room Type</th>
<th>No 0f Bed</th>
<th>Cost Per Term</th>
<th>Description</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($hostelroom as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->name }}</td>
<td>{{ $item->room_type }}</td>
<td>{{ $item->no_of_bed }}</td>
<td>{{ $item->cost_per_bed }}</td>
<td>{{ Str::limit($item->description, 55) }}</td>

<td class="text-end">
<div class="actions">
<button type="button" class="btn btn-sm text-success bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#con-close-modal" id="{{ $item->id }}" onclick="hostelroom(this.id)"><i class="feather-edit"></i></button>


<a href="#" class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.hostel.room', $item->id) }}')">
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




<!-- ADD HOSTEL ROOM --->

<div id="con-close-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<form method="post" action="{{ route('store.hostel.room') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Hostel Room</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">HOSTEL ROOM NAME</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Room Type</label>
<input type="text" class="form-control" id="room_type" name="room_type"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">No Of Bed</label>
<input type="number" min="0"  class="form-control" id="no_of_bed" name="no_of_bed"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Cost Per Bed</label>
<input type="text" class="form-control" id="cost_per_bed" name="cost_per_bed"  >
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
<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
</div>
</div>
</form>
</div>
</div>




<!-- EDIT HOSTEL ROOM --->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<form method="post" action="{{ route('update.hostel.room') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="hostel_room_id" id="hostel_room_id">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit Hostel Room</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">HOSTEL ROOM NAME</label>
<input type="text" class="form-control" id="edit-name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Room Type</label>
<input type="text" class="form-control" id="edit-room_type" name="room_type"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">No Of Bed</label>
<input type="number" min="0"  class="form-control" id="edit-no_of_bed" name="no_of_bed"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Cost Per Bed</label>
<input type="text" class="form-control" id="edit-cost_per_bed" name="cost_per_bed"  >
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
function hostelroom(id){
$.ajax({
type: 'GET',
url: '/edit/hostel/room/'+id,
dataType: 'json',

success:function(data){
// console.log(data)  
$('#edit-name').val(data.name);
$('#edit-room_type').val(data.room_type);
$('#edit-no_of_bed').val(data.no_of_bed);
$('#edit-no_of_bed').val(data.no_of_bed);
$('#edit-cost_per_bed').val(data.cost_per_bed);
$('#hostel_room_id').val(data.id);
}
});
}

</script>




@endsection