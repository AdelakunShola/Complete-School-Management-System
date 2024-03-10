@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE CIRCULAR</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">CIRCULAR</li>
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
<a href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD CIRCULAR</a>
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
<th>Circular Title</th>
<th>Reference Number</th>
<th>Content</th>
<th>Circular Date</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($circular as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->circular_title }}</td>
<td>{{ $item->reference_number }}</td>
<td>{{ Str::limit($item->content, 55) }}</td>
<td>{{ $item->circular_date }}</td>

<td class="text-end">
<div class="actions">
<button type="button" class="btn btn-sm text-success bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#con-close-modal" id="{{ $item->id }}" onclick="circular(this.id)"><i class="feather-edit"></i></button>


<a href="#" class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.circular', $item->id) }}')">
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




<!-- ADD CIRCULAR --->

<div id="con-close-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<form method="post" action="{{ route('store.circular') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Circular</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">CIRCULAR TITLE</label>
<input type="text" class="form-control" id="club_name2" name="circular_title"  >
</div>
</div>
</div>


<div class="col-md-12">
<div class>
<label for="field-7" class="form-label">CONTENT</label>
<textarea class="form-control" id="description" name="content"></textarea>
</div>
</div>

<br><br>
<div class="row">
<div class="col-md-12">
<div class="mb-3 form-group local-forms calendar-icon">
<label for="field-1" class="login-danger form-label">CIRCULAR DATE</label>
<input class="form-control datetimepicker" type="text" id="descp" name="circular_date" placeholder="29-04-2022">
</div>
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




<!-- EDIT SCHOOL CLUB --->

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<form method="post" action="{{ route('update.circular') }}" enctype="multipart/form-data">

@csrf

<input type="hidden" name="id" id="circular_id">

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit Circular</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">
<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">CIRCULAR TITLE</label>
<input type="text" class="form-control" id="circular_title" name="circular_title"  >
</div>
</div>
</div>


<div class="col-md-12">
<div class>
<label for="field-7" class="form-label">CONTENT</label>
<textarea class="form-control" id="content" name="content"></textarea>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3 form-group local-forms calendar-icon">
<label for="field-1" class="login-danger form-label">CIRCULAR DATE</label>
<input class="form-control datetimepicker" type="text" id="circular_date" name="circular_date" placeholder="29-04-2022">
</div>
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


<!-- Bootstrap JS (if using Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<!-- Bootstrap Datepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Your Custom Script -->
<script>
    $(document).ready(function () {
        $('.datetimepicker').datepicker({
            format: 'dd-mm-yyyy hh:ii',
            autoclose: true
        });
    });
</script>


<script>
        function circular(id){
    $.ajax({
        type: 'GET',
        url: '/edit/circular/'+id,
        dataType: 'json',

        success:function(data){
            // console.log(data)  
            $('#circular_title').val(data.circular_title);
            $('#content').val(data.content);
            $('#circular_date').val(data.circular_date);
            $('#club_name_id').val(data.id);
        }
    });
}

    </script>


@endsection