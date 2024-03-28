@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Edit Driver</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">Driver</a></li>
<li class="breadcrumb-item active">Edit Driver</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('update.driver', ['id' => $driver->id]) }}" enctype="multipart/form-data">

@csrf
<input type="hidden" name="id" value="{{ $driver->id }}">
<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Driver Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Driver Name</label>
<input type="text" class="form-control" id="edit-driver_name" name="driver_name" value="{{ $driver->driver_name }}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Phone No.</label>
<input type="text" class="form-control" id="edit-phone" name="phone"  value="{{ $driver->phone }}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Address</label>
<input type="text" class="form-control" id="edit-address" name="address" value="{{ $driver->address }}"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> License Number</label>
<input type="text" class="form-control" id="edit-license_number" name="license_number" value="{{ $driver->license_number }}"  >
</div>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div class="mb-3 calendar-icon">
<label for="field-1" class="form-label"> License Expiry Date</label>
<input type="text" class="form-control datetimepicker" id="edit-license_expiry_date" name="license_expiry_date" value="{{ $driver->license_expiry_date }}"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">guarantor_name</label>
<input type="text" class="form-control" id="edit-guarantor_name" name="guarantor_name" value="{{ $driver->guarantor_name }}" >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">guarantor_phone</label>
<input type="text" class="form-control" id="edit-guarantor_phone" name="guarantor_phone" value="{{ $driver->guarantor_phone }}" >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Guarantor Address</label>
<input type="text" class="form-control" id="edit-guarantor_phone" name="guarantor_address" value="{{ $driver->guarantor_address }}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="edit-status" class="form-label">Status</label>
<select class="form-select" id="edit-status" name="status">
<option value="active" {{ $driver->status === 'active' ? 'selected' : '' }}>Active</option>
<option value="inactive" {{ $driver->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
</select>
</div>
</div>
</div>




<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Your License</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="images" name="license">
</label>
</div>
<img id="showImages" src="{{ !empty($driver->license) ? asset($driver->license) : asset('upload/no_image.jpg') }}" alt="Admin" style="width: 100px; height: 100px;">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Guarantor's ID card</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="image" name="guarantor_id_card">
</label>
</div>
<img id="showImage" src="{{ !empty($driver->guarantor_id_card) ? asset($driver->guarantor_id_card) : asset('upload/no_image.jpg') }}" alt="Admin" style="width: 100px; height: 100px;">
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


<script type="text/javascript">
	$(document).ready(function(){
		$('#images').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImages').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>



@endsection