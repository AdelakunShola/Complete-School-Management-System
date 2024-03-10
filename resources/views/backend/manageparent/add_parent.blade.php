@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Add Parent</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">Parent</a></li>
<li class="breadcrumb-item active">Add Parents</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('store.parent') }}" enctype="multipart/form-data">
@csrf

<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Parent Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Full Name <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="name" placeholder="Enter Full Name">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Email <span class="login-danger">*</span></label>
<input class="form-control" type="email" name="email" placeholder="Enter Email">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Gender<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="gender" placeholder="MALE, FEMALE or OTHERS">
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Password<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="password" placeholder="1234">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Profession <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="profession" placeholder="Enter Profession">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Phone No. <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="phone" placeholder="Mobile Number">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Address<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="address" placeholder="Address">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>State<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="state" placeholder="Enter Your State">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Country<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="country" placeholder="Enter Your Country">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Parent Photo (150px X 150px)</label>
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
<img id="showImage" src="{{ (!empty($all_parent->photo)) ? url('upload/parent/'.$all_parent->photo):url('upload/no_image.jpg') }}" alt="Admin" 
style="width: 100px; height:100px;" >
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