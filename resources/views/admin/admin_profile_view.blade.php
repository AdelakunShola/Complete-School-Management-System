@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row">
<div class="col">
<h3 class="page-title">Profile</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">Profile</li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="profile-header">
<div class="row align-items-center">
<div class="col-auto profile-image">
<a href="#">
<img class="rounded-circle" alt="User Image" src="{{ (!empty($adminData->photo)) ? url('upload/admin_images/'.$adminData->photo):url('upload/no_image.jpg') }}">
</a>
</div>
<div class="col ms-md-n2 profile-user-info">
<h4 class="user-name mb-0">{{$adminData->name}}</h4>
<h6 class="text-muted">UI/UX Design Team</h6>
<div class="user-Location"><i class="fas fa-map-marker-alt"></i> {{$adminData->address}}, {{$adminData->state}}, {{$adminData->country}}.</div>
<div class="about-text">{{$adminData->email}}</div>
</div>
<div class="col-auto profile-btn">
<a class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#con-close-modal"><i class="far fa-edit me-1"></i>Edit</a>
</div>
</div>
</div>
<div class="profile-menu">
<ul class="nav nav-tabs nav-tabs-solid">
<li class="nav-item">
<a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
</li>
<li class="nav-item">
<a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
</li>
</ul>
</div>
<div class="tab-content profile-tab-cont">

<div class="tab-pane fade show active" id="per_details_tab">

<div class="row">
<div class="col-lg-9">
<div class="card">
<div class="card-body">
<h5 class="card-title d-flex justify-content-between">
<span>Personal Details</span>
<a class="edit-link" data-bs-toggle="modal" data-bs-target="#con-close-modal"><i class="far fa-edit me-1"></i>Edit</a>
</h5>
<div class="row">
<p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
<p class="col-sm-9">{{$adminData->name}}</p>
</div>
<div class="row">
<p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Date of Birth</p>
<p class="col-sm-9">{{$adminData->dob}}</p>
</div>
<div class="row">
<p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID</p>
<p class="col-sm-9">{{$adminData->email}}</p>
</div>
<div class="row">
<p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
<p class="col-sm-9">{{$adminData->phone}}</p>
</div>
<div class="row">
<p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
<p class="col-sm-9 mb-0">{{$adminData->address}},<br>
{{$adminData->state}} {{$adminData->zipcode}},<br>
{{$adminData->country}}.</p>
</div>
</div>
</div>
</div>
<div class="col-lg-3">

<div class="card">
<div class="card-body">
<h5 class="card-title d-flex justify-content-between">
<span>Account Status</span>
</h5>
<button class="btn btn-success" type="button"><i class="fe fe-check-verified"></i> {{$adminData->status}}</button>
</div>
</div>


<div class="card">
<div class="card-body">
<h5 class="card-title d-flex justify-content-between">
<span>Skills </span>
</h5>
<div class="skill-tags">
<span>Html5</span>
<span>CSS3</span>
<span>WordPress</span>
<span>Javascript</span>
<span>Android</span>
<span>iOS</span>
<span>Angular</span>
<span>PHP</span>
</div>
</div>
</div>

</div>
</div>

</div>





<div id="password_tab" class="tab-pane fade">
<div class="card">
<div class="card-body">
<h5 class="card-title">Change Password</h5>
<div class="row">
<div class="col-md-10 col-lg-6">
<form method="post" action="{{ route('update_password') }}"  >
@csrf
<div class="form-group">
<label>Old Password</label>
<input type="password" type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="current_password"   placeholder="Old Password" />

@error('old_password')
<span class="text-danger">{{ $message }}</span>
@enderror

</div>
<div class="form-group">
<label>New Password</label>
<input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password"   placeholder="New Password" />

@error('new_password')
<span class="text-danger">{{ $message }}</span>
@enderror

</div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation"   placeholder="Confirm New Password" /> 
</div>
<button class="btn btn-primary" type="submit">Save Changes</button>
</form>
</div>
</div>
</div>
</div>
</div>



</div>
</div>
</div>



</div>




<!-- EDIT PROFILE --->

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit Profile</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">
<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Name</label>
<input type="text" class="form-control" id="field-1" name="name" value="{{$adminData->name}}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Email</label>
<input type="text" class="form-control" id="field-2" name="email" value="{{$adminData->email}}">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-3" class="form-label">Address</label>
<input type="text" class="form-control" id="field-3" name="address" value="{{$adminData->address}}">
</div>
</div>
</div>

<div class="row">
<div class="col-md-4">
<div class="mb-3">
<label for="field-4" class="form-label">State</label>
<input type="text" class="form-control" id="field-4" name="state" value="{{$adminData->state}}">
</div>
</div>
<div class="col-md-4">
<div class="mb-3">
<label for="field-5" class="form-label">Country</label>
<input type="text" class="form-control" id="field-5" name="country" value="{{$adminData->country}}">
</div>
</div>
<div class="col-md-4">
<div class="mb-3">
<label for="field-6" class="form-label">Zip Code / Postal Code</label>
<input type="text" class="form-control" id="field-6" name="zipcode" value="{{$adminData->zipcode}}">
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label for="field-4" class="form-label">Date of Birth :: day/month/year</label>
<input type="text" class="form-control" id="field-4" name="dob" value="{{$adminData->dob}}">
</div>
</div>
<div class="col-md-6">
<div class="mb-3">
<label for="field-5" class="form-label">Phone No.</label>
<input type="text" class="form-control" id="field-5" name="phone" value="{{$adminData->phone}}">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class>
<label for="field-7" class="form-label">Photo</label>
<input type="file" name="photo" class="form-control" id="image" />
</div>
</div>
</div>

<div class="row mb-3">
<div class="col-sm-3">
<h6 class="mb-0"></h6>
</div>
<div class="col-sm-9 text-secondary">
<img id="showImage" src="{{ (!empty($adminData->photo)) ? url('upload/admin_images/'.$adminData->photo):url('upload/no_image.jpg') }}" alt="Admin" 
style="width: 100px; height:100px;" >
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