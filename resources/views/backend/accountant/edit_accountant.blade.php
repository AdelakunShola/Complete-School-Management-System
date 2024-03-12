@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Edit Accountant</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">ACCOUNTANT</a></li>
<li class="breadcrumb-item active">Edit Accountant</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('update.accountant') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{ $librarian->id }}">
<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Accountant Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Full Name <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="name" value="{{ $accountant->name }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>E-Mail <span class="login-danger">*</span></label>
<input class="form-control" type="email" value="email" value="{{ $accountant->email }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Gender <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="gender" value="{{ $accountant->gender }}">
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms calendar-icon">
<label for="field-1">Date Of Birth <span class="login-danger">*</span></label>
<input class="form-control datetimepicker" type="text" name="dob" value="{{ $accountant->dob }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Qualification </label>
<input class="form-control" type="text" name="qualification" value="{{ $accountant->qualification }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms ">
<label>Blood Group <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="blood-group" value="{{ $accountant->blood-group }}">
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms ">
<label>Religion <span class="login-danger">*</span></label>
<input class="form-control " type="text" name="religion" value="{{ $accountant->religion }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Phone </label>
<input class="form-control" type="text" name="phone" value="{{ $accountant->phone }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Marital Status </label>
<input class="form-control" type="text" name="marital_status" value="{{ $accountant->marital_status }}">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>school_attended</label>
<input class="form-control" type="text" name="school_attended" value="{{ $accountant->school_attended }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms calendar-icon">
<label>Graduation Year</label>
<input class="form-control datetimepicker" type="text" name="graduation_year" value="{{ $accountant->graduation_year }}">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Facebook</label>
<input class="form-control" type="text" name="facebook" value="{{ $accountant->facebook }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Twitter</label>
<input class="form-control" type="text" name="twitter" value="{{ $accountant->twitter }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Linkedin</label>
<input class="form-control" type="text" name="linkedin" value="{{ $accountant->linkedin }}">
</div>
</div>




<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Your Photo </label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="image" name="photo">
</label>
</div>
<img id="showImage" src="{{ (!empty($accountant->photo)) ? url('upload/accountant/'.$accountant->photo):url('upload/no_image.jpg') }}" alt="Admin"style="width: 100px; height:100px;" >
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Certificate</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="image" name="certificate">
</label>
</div>
<img id="showImage" src="" alt="Admin"style="width: 100px; height:100px;" >
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload NYSC Certificate</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="image" name="nysc_certificate">
</label>
</div>
<img id="showImage" src="" alt="Admin"style="width: 100px; height:100px;" >
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Additional Document</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="image" name="additional_document">
</label>
</div>
<img id="showImage" src="" alt="Admin"style="width: 100px; height:100px;" >
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Second Additional Document</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="image" name="additional_document2">
</label>
</div>
<img id="showImage" src="" alt="Admin"style="width: 100px; height:100px;" >
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