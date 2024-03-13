@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Edit Alumni</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">Alumni</a></li>
<li class="breadcrumb-item active">Edit Alumni</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('update.alumni') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{ $alumni->id }}">
<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Alumni Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Full Name <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="name" value="{{ $alumni->name }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Email <span class="login-danger">*</span></label>
<input class="form-control" type="email" name="email" value="{{ $alumni->email }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Gender<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="gender" value="{{ $alumni->gender }}">
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Marital Status<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="marital_status" value="{{ $alumni->marital_status }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Profession <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="profession" value="{{ $alumni->profession }}" >
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Phone No. <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="phone" value="{{ $alumni->phone }}">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Graduation Year<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="graduation_year" value="{{ $alumni->graduation_year }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Club<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="club" value="{{ $alumni->club }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Interest<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="interest" value="{{ $alumni->interest }}">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Address<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="address" value="{{ $alumni->address }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>State<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="state" value="{{ $alumni->state }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Country<span class="login-danger">*</span></label>
<input class="form-control" type="text" name="country" value="{{ $alumni->country }}">
</div>
</div>






<div class="row mb-3">
<div class="form-group students-up-files">
<label>Upload Alumni Photo (150px X 150px)</label>
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

<img id="showImage" src="{{ asset($alumni->photo) }}" alt="alumni Photo" style="width: 100px; height:100px;" >
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


<!----<div >
<div class="card">
<div class="card-body">
<h5 class="card-title">Change Password</h5>
<div class="row">
<div class="col-md-10 col-lg-6">
<form method="post" action=""  >
    @csrf
    <div class="form-group">
        <label>Old Password</label>
        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="current_password" placeholder="Old Password" />

        @error('old_password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="New Password" />

        @error('new_password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" placeholder="Confirm New Password" /> 
    </div>
    <button class="btn btn-primary" type="submit">Save Changes</button>
</form>

</div>
</div>
</div>
</div>
</div>--->

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