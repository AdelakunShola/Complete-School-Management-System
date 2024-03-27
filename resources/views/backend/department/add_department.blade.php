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
<form id="department-form" method="post" action="{{ route('store.department') }}" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Department Details</span></h5>
</div>

<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Department Name <span class="login-danger">*</span></label>
<input type="text" name="name" class="form-control">
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Head of Department <span class="login-danger">*</span></label>
<div class="accordion" id="employeeAccordion">
@foreach($employeeNamesByRole as $role => $employees)
<div class="accordion-item">
<h2 class="accordion-header" id="heading{{ $role }}">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $role }}" aria-expanded="false" aria-controls="collapse{{ $role }}">
{{ $role }}
</button>
</h2>
<div id="collapse{{ $role }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $role }}" data-bs-parent="#employeeAccordion">
<div class="accordion-body">
<select class="form-select" name="hod">
<option value="">Choose Head of Department from Teachers</option>
@foreach($employees as $employee)
<option value="{{ $employee->id }}">{{ $employee->name }}</option>
@endforeach
</select>
</div>
</div>
</div>
@endforeach
</div>
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms calendar-icon">
<label>Department Start Date <span class="login-danger">*</span></label>
<input class="form-control datetimepicker" type="text" placeholder="29-04-2022" name="year_started">
</div>
</div>



<!-- Add Designation -->
<div class="col-lg-6 col-md-8">
<div class="card">
<div class="card-header">
<h5 class="card-title">Add Designations</h5>
</div>
<div class="card-body pt-0" id="designation-container">
<!-- Designation input fields will be added dynamically here -->
</div>
<div class="form-group">
<button type="button" id="add-designation" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add More</button>
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






<script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('add-designation').addEventListener('click', function () {
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
                deleteButton.className = 'btn trash';
                deleteButton.innerHTML = '<i class="feather-trash-2"></i>';

                deleteButton.addEventListener('click', function () {
                    div.remove();
                });

                div.appendChild(button);
                div.appendChild(newInput);
                div.appendChild(deleteButton);
                container.appendChild(div);
            });
        });
    </script>

@endsection