@extends('admin.admin_dashboard')
@section('admin')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style>

.select2-container--default .select2-selection--single {
    height: 40px !important; /* Adjust the height as needed */
    border: 1px solid #ccc !important;
    border-radius: 5px !important;
    display: flex; /* Use flexbox to center the text vertically */
    align-items: center; /* Center the text vertically */
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    padding-top: 5px; /* Adjust the padding as needed */
}

    
.select2-container--default .select2-selection--single{
         border: 1px solid #ccc !important; 
         border-radius: 5px !important; 
}

</style>
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Edit Student</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="expenses.html">ADMISSION FORM</a></li>
<li class="breadcrumb-item active">Edit Student</li>
</ul>
</div>
</div>
</div>


</div>
<hr>





<!--ADMISSION FORM PART A-->
<div class="content container-fluid">
<div class="row">
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h5 class="card-title">ADMISSION FORM - Part A</h5>
</div>
<div class="card-body pt-0">
<div class="settings-form allowances-form">



<form method="post" action="{{ route('update.student') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{ $editStudent->id }}">

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Your Photo </label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="img" name="photo">
</label>
</div>
<img id="showImg" class="rounded-circle" alt="Student Image" src="{{ (!empty($studentData->photo)) ? url('upload/student_images/'.$studentData->photo):url('upload/no_image.jpg') }}" style="width: 100px; height:100px;">
</div>
</div>

<div class="col-12 col-md-12">
<div class="form-group local-forms">
<label>Academic Session</label>
<input class="form-control" type="text" name="session" value="{{ $setting->academic_session }}" readonly>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Full Name</label>
<input type="text" class="form-control" id="name" name="name" value="{{ $editStudent->name}}"  >
</div>
</div>
</div>


<div class="row mb-4">
<div class="col-md-12">
<div class="mb-3 position-relative">
<label for="parentSelect1" class="form-label">Select Parent</label>
<div class="d-flex align-items-center">
<select id="parentSelect1" class="select2 form-control" name="parent_id">
<option selected="selected">Select Parent</option>
@foreach($parents as $parent)
<option value="{{ $parent->id }}" {{ $parent->id == $selectedParentId ? 'selected' : '' }}>{{ $parent->name }}</option>
@endforeach
</select>
<div id="searchDropdown1" class="dropdown-menu p-3" style="display: none;">
<input type="text" id="searchInput" class="form-control mb-2" placeholder="Search...">
</div>
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px;"></i>
</span>
</a>
</div>
</div>
</div>
</div>

<div class="row mb-4">
<div class="col-md-12">
<div class="mb-3 position-relative">
<label for="parentSelect2" class="form-label">Select Class</label>
<div class="d-flex align-items-center">
<select id="parentSelect2" class="select2 form-control" name="class_id">
<option selected="selected">Select Class</option>
@foreach($classes as $class)
<option value="{{ $class->id }}" {{ $class->id == $editStudent->class_id ? 'selected' : '' }}>{{ $class->class_name }}</option>
@endforeach
</select>
<div id="searchDropdown2" class="dropdown-menu p-3" style="display: none;">
<input type="text" id="searchInput" class="form-control mb-2" placeholder="Search...">
</div>
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px;"></i>
</span>
</a>
</div>
</div>
</div>
</div>

<div class="row mb-4">
<div class="col-md-12">
<div class="mb-3 position-relative">
<label for="section" class="form-label">Section</label>
<div class="d-flex align-items-center">
<select class="form-control" id="section" name="section_id">
<option value="">Select Section</option>
</select>
<div id="searchDropdown3" class="dropdown-menu p-3" style="display: none;">
<input type="text" id="searchInput" class="form-control mb-2" placeholder="Search...">
</div>
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px;"></i>
</span>
</a>
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3 ">
<label for="birthday" class="form-label ">Birthday<span class="calendar-icon"></span></label>
<input type="text" class="form-control datetimepicker" id="birthday" name="birthday" value="{{ $editStudent->birthday}}">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="age" class="form-label">Age</label>
<input type="text" class="form-control" id="age" name="age" value="{{ $editStudent->age}}" readonly>
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="age" class="form-label">Gender</label>
<input type="text" class="form-control"  name="sex" value="{{ $editStudent->sex}}">
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">State of Origin</label>
<input type="text" class="form-control" id="name" name="state_of_origin"  value="{{ $editStudent->state_of_origin}}">
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Religion</label>
<input type="text" class="form-control" id="name" name="religion" value="{{ $editStudent->religion}}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Tribe</label>
<input type="text" class="form-control" id="name" name="tribe" value="{{ $editStudent->tribe}}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Blood Group</label>
<input type="text" class="form-control" id="name" name="blood_group" value="{{ $editStudent->blood_group}}" >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Address</label>
<input type="text" class="form-control" id="name" name="address"  value="{{ $editStudent->address}}">
</div>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">City</label>
<input type="text" class="form-control" id="name" name="city"  value="{{ $editStudent->city}}">
</div>
</div>
</div>

<div class="row mb-4">
<div class="col-md-12">
<div class="mb-3 position-relative">
<label for="field-1" class="form-label">Student House</label>
<div class="d-flex align-items-center">
<select id="parentSelect4" class="select2 form-control" name="house_id">
<option selected="selected">Select Student House</option>
@foreach($house as $studenthouse)
<option value="{{ $studenthouse->id }}" {{ $studenthouse->id == $editStudent->house_id ? 'selected' : '' }}>{{ $studenthouse->name }}</option>
@endforeach
</select>
<div id="searchDropdown4" class="dropdown-menu p-3" style="display: none;">
<input type="text" id="searchInput" class="form-control mb-2" placeholder="Search...">
</div>
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px;"></i>
</span>
</a>
</div>
</div>
</div>
</div>

<div class="row mb-4">
<div class="col-md-12">
<div class="mb-3 position-relative">
<label for="field-1" class="form-label">Student Club</label>
<div class="d-flex align-items-center">
<select id="parentSelect8" class="select2 form-control" name="club_id">
<option selected="selected">Select Student Club</option>
@foreach($club as $studentclub)
<option value="{{ $studentclub->id }}" {{ $studentclub->id == $editStudent->club_id ? 'selected' : '' }}>{{ $studentclub->club_name }}</option>
@endforeach
</select>
<div id="searchDropdown8" class="dropdown-menu p-3" style="display: none;">
<input type="text" id="searchInput" class="form-control mb-2" placeholder="Search...">
</div>
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px;"></i>
</span>
</a>
</div>
</div>
</div>
</div>



</div>

</div>
</div>
</div>







<!-- ADMISSION FORM - Part A -->
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h5 class="card-title">ADMISSION FORM - Part B</h5>
</div>
<div class="card-body pt-0">

<div class="settings-form deductions-form">



<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;">State <span class="login-danger">*</span></label>
<input type="text" class="form-control" id="name" name="state" value="{{ $editStudent->state}}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;">Nationality <span class="login-danger">*</span></label>
<input type="text" class="form-control" id="name" name="nationality" value="{{ $editStudent->nationality}}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;">Phone <span class="login-danger">*</span></label>
<input type="text" class="form-control" id="name" name="phone" value="{{ $editStudent->phone}}" >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
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
<label style="font-size: 15px;">E-Mail <span class="login-danger">*</span></label>
<input class="form-control" type="email" name="email" value="{{ $editStudent->email}}">
</div>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;">Previous School Name </label>
<input type="text" class="form-control" id="name" name="prev_sch_attended" value="{{ $editStudent->prev_sch_attended}}" >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;">Previous School Address </label>
<input type="text" class="form-control" id="name" name="prev_sch_address" value="{{ $editStudent->prev_sch_address}}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;">Purpose of Leaving</label>
<input type="text" class="form-control" id="name" name="reason_of_leaving_prev_sch" value="{{ $editStudent->reason_of_leaving_prev_sch}}" >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;">Current Class Before Leaving</label>
<input type="text" class="form-control" id="name" name="class_in_prev_sch" value="{{ $editStudent->class_in_prev_sch}}" >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;">Date Of Leaving Previous School</label>
<input type="text" class="form-control datetimepicker" id="name" name="date_of_leaving_prev_sch"  value="{{ $editStudent->date_of_leaving_prev_sch}}">
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;" for="field-1" class="form-label">Physical Handicap</label>
<input type="text" class="form-control" id="name" name="physical_handicap" value="{{ $editStudent->physical_handicap}}" >
</div>
</div>
</div>


<div class="row mb-4">
<div class="col-md-12">
<div class="form-group local-forms position-relative">
<label style="font-size: 15px;" for="field-1" class="form-label">School Hostel/ Dormitory</label>
<div class="d-flex align-items-center">
<select id="parentSelect5" class="select2 form-control" name="hostel_id">
<option selected="selected">Select Student House</option>
@foreach($hostel as $dormitory)
<option value="{{ $dormitory->id }}" {{ $dormitory->id == $editStudent->hostel_id ? 'selected' : '' }}>{{ $dormitory->name }}</option>
@endforeach
</select>
<div id="searchDropdown5" class="dropdown-menu p-3" style="display: none;">
<input type="text" id="searchInput" class="form-control mb-2" placeholder="Search...">
</div>
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px;"></i>
</span>
</a>
</div>
</div>
</div>
</div>


<div class="row mb-4">
<div class="col-md-12">
<div class="form-group local-forms position-relative">
<label style="font-size: 15px;" for="field-1" class="form-label">Student Category</label>
<div class="d-flex align-items-center">
<select id="parentSelect6" class="select2 form-control" name="student_category_id">
<option selected="selected">Select Student Category</option>
@foreach($studentcategory as $scategory)
<option value="{{ $scategory->id }}" {{ $scategory->id == $editStudent->student_category_id ? 'selected' : '' }}>{{ $scategory->name }}</option>
@endforeach
</select>
<div id="searchDropdown6" class="dropdown-menu p-3" style="display: none;">
<input type="text" id="searchInput" class="form-control mb-2" placeholder="Search...">
</div>
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px;"></i>
</span>
</a>
</div>
</div>
</div>
</div>


<div class="row mb-4">
<div class="col-md-12">
<div class="form-group local-forms position-relative">
<label  for="field-1" class="form-label">Transport Route</label>
<div class="d-flex align-items-center">
<select id="parentSelect7" class="select2 form-control" name="transport_id">
<option selected="selected">Select Student House</option>
@foreach($transports as $transport)
<option value="{{ $transport->id }}" {{ $transport->id == $editStudent->transport_id ? 'selected' : '' }}>{{ $transport->name }}</option>
@endforeach
</select>
<div id="searchDropdown7" class="dropdown-menu p-3" style="display: none;">
<input type="text" id="searchInput" class="form-control mb-2" placeholder="Search...">
</div>
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px;"></i>
</span>
</a>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;" for="field-1" class="form-label">Facebook</label>
<input type="text" class="form-control" id="name" name="facebook" value="{{ $editStudent->facebook}}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;" for="field-1" class="form-label">Twitter</label>
<input type="text" class="form-control" id="name" name="twitter" value="{{ $editStudent->twitter}}" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group local-forms">
<label style="font-size: 15px;" for="field-1" class="form-label">Linkedin</label>
<input type="text" class="form-control" id="name" name="linkedin" value="{{ $editStudent->linkedin}}" >
</div>
</div>
</div>

</div>
</div>
</div>
</div>






<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>School Transfer Letter/Transcript</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="tcertificate" name="transfer_cert" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg">
</label>
</div>
<a href="{{ asset($editStudent->transfer_cert) }}" id="showTCertificate">Download School Transfer Letter / Transcript</a>
<span id="tcertificateFileName"><br>File Name: {{ $editStudent->transfer_cert ? basename($editStudent->transfer_cert) : 'No file selected' }}</span>
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Birth Certificate</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="birth_certificate" name="birth_cert" accept=".pdf, .doc, .docx, .jpg, .png, .jpeg">
</label>
</div>
<a href="{{ asset($editStudent->birth_cert) }}" id="showBirthCertificate">Download Birth Certificate</a>
<span id="birthCertificateFileName"><br>File Name: {{ $editStudent->birth_cert ? basename($editStudent->birth_cert) : 'No file selected' }}</span>
</div>
</div>




<div class="col-12">
<div class="student-submit">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>

</form>
</div>
</div>




<script type="text/javascript">
	$(document).ready(function(){
		$('#img').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImg').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>



<script type="text/javascript">
    $(document).ready(function () {
    // Function to handle file input change for transfer certificate
    $('#tcertificate').change(function (e) {
            var fileName = e.target.files[0].name;
            $('#tcertificateFileName').text('File Name: ' + fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showTCertificate').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    // Function to handle file input change for birth Certificate
    $('#birth_certificate').change(function (e) {
            var fileName = e.target.files[0].name;
            $('#birthCertificateFileName').text('File Name: ' + fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showBirthCertificate').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });

   
});
</script>


<script>
$(document).ready(function(){
    $('select[name="class_id"]').on('change', function(){
        var class_id = $(this).val();
        if (class_id) {
            $.ajax({
                url: "{{ url('/sections/ajax') }}/"+class_id,
                type: "GET",
                dataType: "json",
                success: function(data){
                    var sectionDropdown = $('select[name="section_id"]');
                    sectionDropdown.html('<option value="">Select Section</option>');
                    $.each(data, function(key, value){
                        sectionDropdown.append('<option value="'+ value.id + '">' + value.name + '</option>');
                    });
                },
            });
        } else {
            var sectionDropdown = $('select[name="section_id"]');
            sectionDropdown.html('<option value="">Select Section</option>');
        }
    });

    // Show only sections related to the selected class
    $('select[name="section_id"]').on('focus', function(){
        var class_id = $('select[name="class_id"]').val();
        if (class_id) {
            $.ajax({
                url: "{{ url('/sections/ajax') }}/"+class_id,
                type: "GET",
                dataType: "json",
                success: function(data){
                    var sectionDropdown = $('select[name="section_id"]');
                    sectionDropdown.empty().append('<option value="">Select Section</option>');
                    $.each(data, function(key, value){
                        sectionDropdown.append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                },
            });
        } else {
            alert('Please select a class first');
        }
    });
});
</script>



<script>
$(document).ready(function(){
    // Function to populate sections based on the selected class
    function populateSections(class_id) {
        if (class_id) {
            $.ajax({
                url: "{{ url('/sections/ajax') }}/" + class_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var sectionDropdown = $('select[name="section_id"]');
                    sectionDropdown.empty().append('<option value="">Select Section</option>');
                    $.each(data, function(key, value) {
                        var option = '<option value="' + value.id + '"';
                        if (value.id == "{{ $editStudent->section_id }}") {
                            option += ' selected';
                        }
                        option += '>' + value.name + '</option>';
                        sectionDropdown.append(option);
                    });
                },
            });
        } else {
            var sectionDropdown = $('select[name="section_id"]');
            sectionDropdown.html('<option value="">Select Section</option>');
        }
    }

    // On change event for the class dropdown
    $('select[name="class_id"]').on('change', function() {
        var class_id = $(this).val();
        populateSections(class_id);
    });

    // On focus event for the section dropdown
    $('select[name="section_id"]').on('focus', function() {
        var class_id = $('select[name="class_id"]').val();
        populateSections(class_id);
    });

    // Initially populate sections based on the selected class
    var initialClassId = $('select[name="class_id"]').val();
    populateSections(initialClassId);
});
</script>





<script>
    // get age from birthday
    $(document).ready(function() {
        // Attach change event listener to the birthday input field
        $('#birthday').change(function() {
            // Get the selected birthday value
            var birthday = $(this).val();

            // Calculate age based on the selected birthday
            var age = calculateAge(birthday);

            // Update the age input field
            $('#age').val(age);
        });

        // Function to calculate age based on the given birthday
        function calculateAge(birthday) {
            var today = new Date();
            var birthDate = new Date(birthday);
            var age = today.getFullYear() - birthDate.getFullYear();
            var month = today.getMonth() - birthDate.getMonth();
            if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }
    });
</script>










<script>
    $('.select2').select2();
</script>

@endsection