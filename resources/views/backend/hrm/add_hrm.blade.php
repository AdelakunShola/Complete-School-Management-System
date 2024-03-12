@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Add HRM</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">HRM</a></li>
<li class="breadcrumb-item active">Add HRM</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('store.hrm') }}" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-12">
<h5 class="form-title student-info">HRM Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Full Name <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="name">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>E-Mail <span class="login-danger">*</span></label>
<input class="form-control" type="email" name="email">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Gender <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="gender">
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms calendar-icon">
<label for="field-1">Date Of Birth <span class="login-danger">*</span></label>
<input class="form-control datetimepicker" type="text" name="dob" placeholder="DD-MM-YYYY">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Qualification </label>
<input class="form-control" type="text" name="qualification" placeholder="Bsc Engineering">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms ">
<label>Blood Group <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="blood_group" >
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms ">
<label>Religion <span class="login-danger">*</span></label>
<input class="form-control " type="text" name="religion" >
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Phone </label>
<input class="form-control" type="text" name="phone">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Marital Status </label>
<input class="form-control" type="text" name="marital_status">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>school_attended</label>
<input class="form-control" type="text" name="school_attended">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms calendar-icon">
<label>Graduation Year</label>
<input class="form-control datetimepicker" type="text" name="graduation_year" placeholder="DD-MM-YYYY">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Password</label>
<input class="form-control" type="text" name="password">
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Facebook</label>
<input class="form-control" type="text" name="facebook">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Twitter</label>
<input class="form-control" type="text" name="twitter">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Linkedin</label>
<input class="form-control" type="text" name="linkedin">
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
<img id="showImage" src="" alt="Admin"style="width: 100px; height:100px;" >
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
<a href="#" id="showCertificate">Download Certificate</a>
<span id="certificateFileName"></span>
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

<a href="#" id="showNYSCCertificate" id="downloadLink">Download NYSC Certificate</a>
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
<a id="showAdditionalDocument" href="#" id="downloadLink">Download Addition Document</a>
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
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showNYSCCertificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);

        });

        // Function to handle file input change for NYSC Certificate
        $('#additional_document').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showAdditionalDocument').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });


		// Function to handle file input change for NYSC Certificate
        $('#additional_document2').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showAdditionalDocument2').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

    });
</script>


@endsection