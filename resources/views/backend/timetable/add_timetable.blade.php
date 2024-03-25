@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col-sm-12">
<div class="page-sub-header">
<h3 class="page-title">Add Timetable / Class Routine</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="students.html">Timetable / Class Routine</a></li>
<li class="breadcrumb-item active">Add Timetable / Class Routine</li>
</ul>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card comman-shadow">
<div class="card-body">
<form method="post" action="{{ route('store.timetable') }}" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-12">
<h5 class="form-title student-info">Timetable / Class Routine Information <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span></h5>
</div>




<div class="col-md-12">
<div class="card">
<div class="card-body pt-0">
<div class="settings-form">

<div class="form-group local-forms">
<label>Select Class</label>
<select class="form-control" name="class_id">
<option value="">Select Class</option>
@foreach($classes as $class)
<option value="{{ $class->id }}">{{ $class->class_name }}</option>
@endforeach
</select>
</div>

<div class="form-group local-forms">
    <label for="designation">Select Section <span class="login-danger">*</span></label>
    <select class="form-control" id="section" name="section_id">
        <option value="">Select Section</option>
    </select>
</div>


<div class="form-group local-forms">
    <label for="designation">Select Subject <span class="login-danger">*</span></label>
    <select class="form-control" id="subject" name="subjects_id">
        <option value="">Select Subject</option>
    </select>
</div>

<div class="form-group local-forms">
    <label>Select Day<span class="login-danger">*</span></label>
    <select class="form-control" name="day">
        <option value="">Select Day</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
    </select>
</div>


</div>
</div>
</div>
</div>






<div class="card-header">
<h5 class="card-title">STARTING TIME</h5>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Hour</label>
<select class="form-control" name="time_start">
<option selected="selected">Select Hour</option>
@for($i = 1; $i <= 12; $i++)
<option value="{{ $i }}">{{ $i }}</option>
@endfor
</select>
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Minutes</label>
<select class="form-control" name="time_start_min">
<option selected="selected">Select Minutes</option>
@for($i = 0; $i <= 55; $i += 5)
                {{-- Use sprintf to format the minutes with leading zeros --}}
                <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
            @endfor
</select>
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>AM or PM</label>
<select class="form-control" name="start_day_period">
<option selected="selected">Select AM / PM</option>
<option value="1">AM</option>
<option value="2">PM</option>
</select>
</div>
</div>






<div class="card-header">
<h5 class="card-title">ENDING TIME </h5>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Hour</label>
<select class="form-control" name="time_end">
<option selected="selected">Select Hour</option>
@for($i = 1; $i <= 12; $i++)
<option value="{{ $i }}">{{ $i }}</option>
@endfor
</select>
</div>
</div>
<div class="col-12 col-sm-4">
    <div class="form-group local-forms">
        <label>Minutes</label>
        <select class="form-control" name="time_end_min">
            <option selected="selected">Select Minutes</option>
            @for($i = 0; $i <= 55; $i += 5)
                {{-- Use sprintf to format the minutes with leading zeros --}}
                <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
            @endfor
        </select>
    </div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>AM or PM</label>
<select class="form-control" name="end_day_period">
<option selected="selected">Select</option>
<option value="1">AM</option>
<option value="2">PM</option>
</select>
</div>
</div>

@php
$settings = App\Models\Settings::latest()->first(); 
$academicSession = $settings->academic_session;
@endphp

<div class="col-12 col-sm-4" style="display: none;">
<div class="form-group local-forms">
<label>Year <span class="login-danger">*</span></label>
<input class="form-control" type="text" name="year" value="{{ $academicSession }}">
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





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




<script type="text/javascript">
  		
  		$(document).ready(function(){
    $('select[name="class_id"]').on('change', function(){
        var class_id = $(this).val();
        if (class_id) {
            $.ajax({
                url: "{{ url('/subject/ajax') }}/"+class_id,
                type: "GET",
                dataType:"json",
                success:function(data){
                    var subjectDropdown = $('select[name="subjects_id"]');
                    subjectDropdown.html('<option value="">Select Subject</option>'); // Set default option
                    $.each(data, function(key, value){
                        subjectDropdown.append('<option value="'+ value.id + '">' + value.name + '</option>');
                    });
                },
            });
        } else {
            $('select[name="subjects_id"]').html('<option value="">Select Subject</option>'); // Set default option
        }
    });
});

  </script>

<script>

$(document).ready(function(){
    $('select[name="class_id"]').on('change', function(){
        var class_id = $(this).val();
        if (class_id) {
            $.ajax({
                url: "{{ url('/section/ajax') }}/"+class_id,
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
});

</script>

@endsection