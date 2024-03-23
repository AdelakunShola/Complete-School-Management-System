@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE SCHOOL SECTION</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">SCHOOL SECTION</li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<a href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD SCHOOL SECTION </a>
</div>
<div class="col-auto text-end float-end ms-auto download-grp">
<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
</div>
</div>
</div>

<div class="table-responsive">


    <!-- Add the dropdown menu above the table -->
<div class="mb-3">
    <label for="filter-class" class="form-label">Filter by Class</label>
    <select class="form-select" id="filter-class">
        <option value="">All Classes</option>
        @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->class_name }}</option>
        @endforeach
    </select>
</div>


<table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
<thead class="student-thread">
<tr>
<th>S/N</th>
<th>Name</th>
<th>Nick Name</th>
<th>Class Name</th>
<th>Teacher</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($section as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->name }}</td>
<td>{{ $item->nick_name }}</td>
<td>{{ $item->class->class_name }}</td>
<td>{{ $item->users->name }}</td>

<td class="text-end">
<div class="actions">
<button type="button" class="btn btn-sm text-success bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#con-close-modal" id="{{ $item->id }}" onclick="section(this.id)"><i class="feather-edit"></i></button>


<a href="#" class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.section', $item->id) }}')">
    <i class="feather-trash"></i>
</a>


</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>




<!-- ADD SCHOOL CLUB --->

<div id="con-close-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<form method="post" action="{{ route('store.section') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Section</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">NAME</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">NICK NAME</label>
<input type="text" class="form-control" id="name" name="nick_name"  >
</div>
</div>
</div>

<div class="col-md-12">
    <div class="mb-3">
        <label for="teacher_id" class="form-label">CLASS NAME</label>
        <select class="form-select" id="class_id" name="class_id">
            <option value="">Select Class Name</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-md-12">
    <div class="mb-3">
        <label for="teacher_id" class="form-label">Teacher's Name</label>
        <select class="form-select" id="teacher_id" name="teacher_id">
            <option value="">Select Teacher</option>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
    </div>
</div>





</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
</div>
</div>
</form>
</div>
</div>




<!-- EDIT CLASS --->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<form method="post" action="{{ route('update.section') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="section_id" id="section_id">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit School Section</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">
<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">NAME</label>
<input type="text" class="form-control" id="edit-name" name="name"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">NICK NAME</label>
<input type="text" class="form-control" id="edit-nick_name" name="nick_name"  >
</div>
</div>
</div>

<div class="col-md-12">
<div class="mb-3">
<label for="edit-teacher_id" class="form-label">CLASS NAME</label>
<select class="form-select" id="edit-class_id" name="class_id">
<option value="">Select Class</option>
@foreach($classes as $class)
<option value="{{ $class->id }}" {{$class->class_name == $class->id ? 'selected' : '' }}>{{ $class->class_name }}</option>
@endforeach
</select>
</div>
</div>


<div class="col-md-12">
<div class="mb-3">
<label for="edit-teacher_id" class="form-label"> TEACHER </label>
<select class="form-select" id="edit-teacher_id" name="teacher_id">
<option value="">Select Teacher</option>
@foreach($teachers as $teacher)
<option value="{{ $teacher->id }}" {{$teacher->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
@endforeach
</select>
</div>
</div>


</div>



<div class="modal-footer">
<button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
</div>
</div>
</form>
</div>
</div>



<script>
        function section(id){
    $.ajax({
        type: 'GET',
        url: '/edit/section/'+id,
        dataType: 'json',

        success:function(data){
            // console.log(data)  
            $('#edit-class_id').val(data.class_id);
            $('#edit-name').val(data.name);
            $('#edit-nick_name').val(data.nick_name);
            $('#edit-teacher_id').val(data.teacher_id);
            $('#section_id').val(data.id);
        }
    });
}

    </script>




@endsection