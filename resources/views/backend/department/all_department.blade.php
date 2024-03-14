@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE DEPARTMENTS</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">ALL DEPARTMENTS </li>
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
<a href="{{ route('add.department') }}" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD DEPARTMENTS </a>
</div>
<div class="col-auto text-end float-end ms-auto download-grp">
<a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
</div>
</div>
</div>

<div class="table-responsive">
<table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
<thead class="student-thread">
<tr>
<th>S/N</th>
<th>Department ID</th>
<th>Department Name</th>
<th>Designation </th>
<th>HOD </th>
<th>Year Started</th>
<th>Total Teachers</th>
<th>No of Students</th>


<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($department as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->department_id }}</td>
<td>{{ $item->name }}</td>
<td>{{ $item->designation_name }}</td>
<td>{{ $item->hod }}</td>
<td>{{ $item->year_started }}</td>
<td>{{ $item->employees }}</td>
<td>{{ $item->students }}</td>

<td class="text-end">
<div class="actions">


<a href="{{ route('edit.department', $item->id) }}" class="btn btn-sm text-success bg-success-light me-2" >
    <i class="feather-edit"></i>
</a>

<a class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.department', $item->id) }}')">
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








@endsection