@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Edit Hostel</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">Hostel</a></li>
<li class="breadcrumb-item active">Edit Hostel</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('update.hostel') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{ $edithostel->id }}">

<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Hostel Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Name <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="name" value="{{ $edithostel->name }}">
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Select Hostel Category</label>
<select class="form-control" name="hostel_category_id">
<option value="">Select Class</option>
@foreach($hostelcategory as $hcategory)
<option value="{{ $hcategory->id }}" {{ $hcategory->id == $edithostel->hostel_category_id ? 'selected' : '' }}>{{ $hcategory->name }}</option>
@endforeach
</select>
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Select Hostel Room</label>
<select class="form-control" name="hostel_room_id">
<option value="">Select Hotel Room</option>
@foreach($hostelroom as $hroom)
<option value="{{ $hroom->id }}" {{ $hroom->id == $edithostel->hostel_room_id ? 'selected' : '' }}>{{ $hroom->name }}</option>
@endforeach
</select>
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Capacity<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="capacity" value="{{ $edithostel->capacity }}">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Address<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="address" value="{{ $edithostel->address }}">
</div>
</div>

<div class="col-12 col-sm-12">
<div class="form-group local-forms">
<label>Description<span class="login-danger">*</span></label>
<textarea class="form-control" type="text" name="description" value="{{ $edithostel->description }}"></textarea>
</div>
</div>



<div class="row mb-3">
<div class="form-group students-up-files">
<label>Upload Hostel Picture Photo </label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" name="photo" id="image">
</label>
</div>
</div>
</div>

<div class="row mb-3">
<div class="col-sm-3">
<h6 class="mb-0"></h6>
</div>
<div class="col-sm-9 text-secondary">

<img id="showImage" src="{{ asset($edithostel->photo) }}" alt="hostel Photo" style="width: 100px; height:100px;" >
</div>
</div>



<div class="col-12">
<div class="student-submit">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


@endsection