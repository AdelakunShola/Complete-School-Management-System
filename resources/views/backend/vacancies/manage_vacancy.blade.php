@extends('admin.admin_dashboard')
@section('admin')

@php
$vacancy = App\Models\Vacancy::get();
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE VACANCY</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">VACANCIES</li>
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
<a href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD VACANCY </a>
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
<th>Name</th>
<th>Number Of Vacancy</th>
<th>Deadline</th>
<th>Description</th>
<th>Posted on</th>
<th>Status</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($vacancies as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->name }}</td>
<td>{{ $item->number_of_vacancy }}</td>
<td>{{ $item->deadline }}</td>
<td>{{ $item->description }}</td>
<td>{{ $item->created_at->format('d M Y H:i:s') }}</td>
<td> @if ($item->status == '0')
    <span class="text-success">Active</span>
    @elseif ($item->status == '1')
    <span class="text-danger">InActive</span>
    @endif </td>

<td class="text-end">
<div class="actions">
<button type="button" class="btn btn-sm text-success bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#con-close-modal" id="{{ $item->id }}" onclick="vacancy(this.id)"><i class="feather-edit"></i></button>


<a href="#" class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.vacancy', $item->id) }}')">
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




<!-- ADD Vacancy --->

<div id="con-close-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<form method="post" action="{{ route('store.vacancy') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Vacancy</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Position</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">No Of Vacancy</label>
<input type="number" min="0" class="form-control" id="number_of_vacancy" name="number_of_vacancy"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3 form-group local-forms calendar-icon">
<label for="field-1" class="login-danger form-label">DEADLINE</label>
<input class="form-control datetimepicker" type="text" id="deadline" name="deadline" placeholder="29-04-2022">
</div>
</div>
</div>

<div class="col-md-12">
<div class>
<label for="field-7" class="form-label">DESCRIPTION</label>
<textarea class="form-control" id="description" name="description"></textarea>
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




<!-- EDIT Vacancy --->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form method="post" action="{{ route('update.vacancy') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="name_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Vacancy</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">

                <div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Position</label>
<input type="text" class="form-control" id="edit-name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">No Of Vacancy</label>
<input type="number" min="0" class="form-control" id="edit-number_of_vacancy" name="number_of_vacancy"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3 form-group local-forms calendar-icon">
<label for="field-1" class="login-danger form-label">DEADLINE</label>
<input class="form-control datetimepicker" type="text" id="edit-deadline" name="deadline" placeholder="29-04-2022">
</div>
</div>
</div>

<div class="col-md-12">
<div class>
<label for="field-7" class="form-label">DESCRIPTION</label>
<textarea class="form-control" id="edit-description" name="description"></textarea>
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label>STATUS <span class="star-red">*</span></label>
<select id="edit-status" name="status" class="select form-control">
<option selected disabled>Edit Status..</option>
    <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Active</option>
    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>InActive</option>
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
        function vacancy(id){
            $.ajax({
        type: 'GET',
        url: '/edit/vacancy/'+id,
        dataType: 'json',
        success:function(data){
            $('#edit-name').val(data.name);
            $('#edit-number_of_vacancy').val(data.number_of_vacancy);
            $('#edit-description').val(data.description);
            $('#edit-deadline').val(data.deadline);
            $('#edit-status').val(data.status);
            $('#name_id').val(data.id);
            $('#con-close-modal').modal('show'); // Show the modal after data is populated
        }
    });
}


    </script>




@endsection