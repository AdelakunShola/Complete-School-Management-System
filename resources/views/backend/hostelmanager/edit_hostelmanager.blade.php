@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Edit HOSTEL MANAGER</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">Hostel Manager</a></li>
<li class="breadcrumb-item active">Edit Hostel Manager</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('update.hostelmanager') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{ $hostelmanager->id }}">
<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Hostel Manager Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Full Name <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="name" value="{{ $hostelmanager->name }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<label>E-Mail <span class="login-danger">*</span></label>
<input class="form-control" type="email" value="email" value="{{ $hostelmanager->email }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Gender <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="gender" value="{{ $hostelmanager->gender }}">
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms calendar-icon">
<label for="field-1">Date Of Birth <span class="login-danger">*</span></label>
<input class="form-control datetimepicker" type="text" name="dob" value="{{ $hostelmanager->dob }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Qualification </label>
<input class="form-control" type="text" name="qualification" value="{{ $hostelmanager->qualification }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms ">
<label>Blood Group <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="blood-group" value="{{ $hostelmanager->blood-group }}">
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms ">
<label>Religion <span class="login-danger">*</span></label>
<input class="form-control " type="text" name="religion" value="{{ $hostelmanager->religion }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Phone </label>
<input class="form-control" type="text" name="phone" value="{{ $hostelmanager->phone }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Marital Status </label>
<input class="form-control" type="text" name="marital_status" value="{{ $hostelmanager->marital_status }}">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>school_attended</label>
<input class="form-control" type="text" name="school_attended" value="{{ $hostelmanager->school_attended }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms calendar-icon">
<label>Graduation Year</label>
<input class="form-control datetimepicker" type="text" name="graduation_year" value="{{ $hostelmanager->graduation_year }}">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Facebook</label>
<input class="form-control" type="text" name="facebook" value="{{ $hostelmanager->facebook }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Twitter</label>
<input class="form-control" type="text" name="twitter" value="{{ $hostelmanager->twitter }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Linkedin</label>
<input class="form-control" type="text" name="linkedin" value="{{ $hostelmanager->linkedin }}">
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
<img id="showImage" src="{{ asset($hostelmanager->photo) }}" alt="Admin"style="width: 100px; height:100px;" >
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Certificate</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="certificate" name="certificate" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg">
</label>
</div>
<a href="{{ asset($hostelmanager->certificate) }}" id="showCertificate">Download Certificate</a>
<span id="certificateFileName"><br>File Name: {{ $hostelmanager->certificate ? basename($hostelmanager->certificate) : 'No file selected' }}</span>
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload NYSC Certificate</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="nysc_certificate" name="nysc_certificate" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg">
</label>
</div>
<a href="{{ asset($hostelmanager->nysc_certificate) }}" id="showNyscCertificate" id="downloadLink">Download NYSC Certificate</a>
<span id="nyscCertificateFileName"><br>File Name: {{ $hostelmanager->nysc_certificate ? basename($hostelmanager->nysc_certificate) : 'No file selected' }}</span>
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Additional Document</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="additional_document" name="additional_document" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg">
</label>
</div>
<a id="showAdditionalDocument" href="{{ asset($hostelmanager->additional_document) }}" id="downloadLink">Download Addition Document</a>
<span id="additionalDocumentFileName"><br>File Name: {{ $hostelmanager->additional_document ? basename($hostelmanager->additional_document) : 'No file selected' }}</span>
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Second Additional Document</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="additional_document2" name="additional_document2" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg">
</label>
</div>
<a id="showAdditionalDocument2" href="{{ asset($hostelmanager->additional_document2) }}" id="downloadLink">Download Addition Document</a>
<span id="additionalDocument2FileName"><br>File Name: {{ $hostelmanager->additional_document2 ? basename($hostelmanager->additional_document2) : 'No file selected' }}</span>
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
    $(document).ready(function () {
    // Function to handle file input change for certificate
    $('#certificate').change(function (e) {
        var fileName = e.target.files[0].name;
        $('#certificateFileName').text('File Name: ' + fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showCertificate').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    // Function to handle file input change for NYSC Certificate
    $('#nysc_certificate').change(function (e) {
		var fileName = e.target.files[0].name;
        $('#nyscCertificateFileName').text('File Name: ' + fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showNyscCertificate').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });

    // Function to handle file input change for Additional Document
    $('#additional_document').change(function (e) {
		var fileName = e.target.files[0].name;
        $('#additionalDocumentFileName').text('File Name: ' + fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showAdditionalDocument').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });

    // Function to handle file input change for Second Additional Document
    $('#additional_document2').change(function (e) {
		var fileName = e.target.files[0].name;
        $('#additionalDocument2FileName').text('File Name: ' + fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showAdditionalDocument2').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});
</script>


@endsection