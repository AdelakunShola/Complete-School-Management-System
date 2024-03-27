@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">View Applicant</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">APPLICATION</a></li>
<li class="breadcrumb-item active">View Applicant</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<div class="page-header">
<div class="row align-items-center">
<div class="col">
<a href="{{ route('add.application') }}" class="btn btn-outline-primary me-2"><i
class="fas fa-plus"></i> ADD APPLICATION </a>
</div>
<div class="col-auto text-end float-end ms-auto download-grp">
<a href="{{ route('all.application') }}" class="btn btn-outline-primary me-2">All Application</a>
</div>
</div>
</div>
<form method="post" action="{{ route('update.application') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" id="id" value="{{ $applicant->id }}">

<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Applicant Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Full Name <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="applicant_name" value="{{ $applicant->applicant_name }}" readonly>
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
<input class="form-control" type="email" name="email"  value="{{ $applicant->email }}" readonly>
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label for="inputVendor" class="form-label" >Select Vacancy</label>
<select name="vacancy_id" class="form-select" id="inputVendor" disabled>
<option></option>
@foreach($vacancy as $vac)
<option  value="{{ $vac->id }}" {{ $applicant->vacancy_id == $vac->id ? 'selected' : '' }}>{{ $vac->name }}</option>
@endforeach
</select>
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>CV</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">

</label>
</div>
<a id="showCv" href="{{ asset($applicant->cv) }}" id="downloadLink">Download Cover Letter</a>
<span id="cvFileName"><br>File Name: {{ $applicant->cv ? basename($applicant->cv) : 'No file selected' }}</span>
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Cover Letter</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">

</label>
</div>
<a id="showCoverLetter" href="{{ asset($applicant->cover_letter) }}" id="downloadLink">Download Cover Letter</a>
<span id="coverLetterFileName"><br>File Name: {{ $applicant->cover_letter ? basename($applicant->cover_letter) : 'No file selected' }}</span>
</div>
</div>

<div class="col-12">
<h5 class="form-title student-info">Update Applicant Status <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>

<div class="col-12 col-sm-12">
    <div class="form-group local-forms">
        <label>UPDATE STATUS<span class="login-danger">*</span></label>
        <select class="form-control" name="status">
            <option value="0" {{ $applicant->status == '0' ? 'selected' : '' }}>Applied</option>
            <option value="1" {{ $applicant->status == '1' ? 'selected' : '' }}>On Review</option>
            <option value="2" {{ $applicant->status == '2' ? 'selected' : '' }}>Interview</option>
            <option value="3" {{ $applicant->status == '3' ? 'selected' : '' }}>Offered</option>
            <option value="4" {{ $applicant->status == '4' ? 'selected' : '' }}>Hired</option>
            <option value="5" {{ $applicant->status == '5' ? 'selected' : '' }}>Declined</option>
        </select>
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
    // Function to handle file input change for certificate
    $('#cv').change(function (e) {
        var fileName = e.target.files[0].name;
        $('#cvFileName').text('File Name: ' + fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showCv').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    // Function to handle file input change for NYSC Certificate
    $('#cover_letter').change(function (e) {
		var fileName = e.target.files[0].name;
        $('#coverLetterFileName').text('File Name: ' + fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showCoverLetter').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });


    
});
</script>

@endsection
