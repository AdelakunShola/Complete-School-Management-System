@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Add Application</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">APPLICATION</a></li>
<li class="breadcrumb-item active">Add Application</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('store.application') }}" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Application Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Full Name <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="applicant_name">
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
<input class="form-control" type="email" name="email">
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label for="inputVendor" class="form-label">Select Vacancy</label>
<select name="vacancy_id" class="form-select" id="inputVendor">
<option></option>
@foreach($vacancy as $vac)
<option value="{{ $vac->id }}">{{ $vac->name }}</option>
@endforeach
</select>
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload CV</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="cv" name="cv" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg">
</label>
</div>
<p id="cvFileName"></p> <!-- Element to display file name -->
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Cover Letter</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="cover_letter" name="cover_letter" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg">
</label>
</div>
<p id="coverLetterFileName"></p> <!-- Element to display file name -->
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
    $(document).ready(function () {
        // Function to handle file input change for CV
        $('#cv').change(function (e) {
            var fileName = e.target.files[0].name;
            $('#cvFileName').text('File Name: ' + fileName);
        });

        // Function to handle file input change for cover letter
        $('#cover_letter').change(function (e) {
            var fileName = e.target.files[0].name;
            $('#coverLetterFileName').text('File Name: ' + fileName);
        });
    });
</script>

@endsection
