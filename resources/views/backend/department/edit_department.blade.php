@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Add Department</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="departments.html">Department</a></li>
<li class="breadcrumb-item active">Add Department</li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">

<form method="post" action="{{ route('update.department', $department->id) }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{ $department->id }}">
<input type="hidden" id="designation_count" value="{{ count($designation) }}">


<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Department Details</span></h5>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Department Name <span class="login-danger">*</span></label>
<input type="text" name="name" class="form-control" value="{{ $department->name }}">
</div>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Head of Department <span class="login-danger">*</span></label>
<select class="form-select" id="edit-employee_id" name="hod">
<option value="">Select Head of Department</option>
@foreach($employeeNamesByRole as $role => $employees)
<optgroup label="{{ $role }}">
@foreach($employees as $employee)
<option value="{{ $employee->id }}" {{ $department->hod == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
@endforeach
</optgroup>
@endforeach
</select>
</div>
</div>




<div class="col-12 col-sm-4">
<div class="form-group local-forms calendar-icon">
<label>Department Start Date <span class="login-danger">*</span></label>
<input class="form-control datetimepicker" type="text" value="{{ $department->year_started }}" name="year_started">
</div>
</div>


<!-- Add Designation -->
<div class="col-lg-6 col-md-8" id="designation-container">
<!-- Existing designations -->
@foreach($designation as $index => $desig)
<div class="form-group form-placeholder d-flex">
<button class="btn social-icon">
<i class="feather-github"></i>
</button>
<input type="text" class="form-control" name="designation_name[]" value="{{ $desig->designation_name }}">
<div>
<a href="#" class="btn trash delete-designation">
<i class="feather-trash-2"></i>
</a>
</div>
</div>
@endforeach
</div>

<!-- Add More button to add more designation fields -->
<div class="form-group">
    <button type="button" id="add-designation" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add More</button>
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle addition of more designations
        document.getElementById('add-designation').addEventListener('click', function () {
            var count = parseInt(document.getElementById('designation_count').value);
            var container = document.getElementById('designation-container');
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.className = 'form-control';
            newInput.name = 'designation_name[]';
            newInput.placeholder = 'Add Designation';

            var div = document.createElement('div');
            div.className = 'form-group form-placeholder d-flex';

            var button = document.createElement('button');
            button.className = 'btn social-icon';
            var icon = document.createElement('i');
            icon.className = 'feather-github';
            button.appendChild(icon);

            var deleteButton = document.createElement('button');
            deleteButton.className = 'btn trash delete-designation';
            deleteButton.innerHTML = '<i class="feather-trash-2"></i>';

            deleteButton.addEventListener('click', function () {
                div.remove();
            });

            div.appendChild(button);
            div.appendChild(newInput);
            div.appendChild(deleteButton);
            container.appendChild(div);

            // Increment the count
            document.getElementById('designation_count').value = count + 1;
        });

        // Handle deletion of designation
        document.querySelectorAll('.delete-designation').forEach(item => {
            item.addEventListener('click', event => {
                event.target.closest('.form-group').remove();
            });
        });
    });
</script>







@endsection