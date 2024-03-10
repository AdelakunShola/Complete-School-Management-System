@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE ENQUIRY CATEGORY</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">ENQUIRY CATEGORY</li>
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
<a href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD ENQUIRY CATEGORY </a>
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
<th>Category</th>
<th>Purpose</th>
<th>To-Whom</th>
<th>Date</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($enquiry_category as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->category }}</td>
<td>{{ $item->purpose }}</td>
<td>{{ $item->whom }}</td>
<td>{{ $item->created_at }}</td>

<td class="text-end">
<div class="actions">
<button type="button" class="btn btn-sm text-success bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#con-close-modal" id="{{ $item->id }}" onclick="enquirycategory(this.id)"><i class="feather-edit"></i></button>


<a href="#" class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.enquiry.category', $item->id) }}')">
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




<!-- ADD ENQUIRY CATEGORY --->

<div id="con-close-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<form method="post" action="{{ route('store.enquiry.category') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Enquiry Category</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Category</label>
<input type="text" class="form-control" id="field-1" name="category"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Purpose</label>
<input type="text" class="form-control" id="field-2" name="purpose" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-3" class="form-label">To Whom</label>
<input type="text" class="form-control" id="field-3" name="whom" >
</div>
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




<!-- EDIT ENQUIRY CATEGORY --->

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<form method="post" action="{{ route('update.enquiry.category') }}" enctype="multipart/form-data">
@csrf

<input  type="hidden" name="category_id" id="category_id" >
<input  type="hidden" name="purpose_id" id="purpose_id" >
<input  type="hidden" name="whom_id" id="whom_id" >

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit Enquiry Category</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Category</label>
<input type="text" class="form-control" id="category" name="category"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Purpose</label>
<input type="text" class="form-control" id="purpose" name="purpose" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-3" class="form-label">To Whom</label>
<input type="text" class="form-control" id="whom" name="whom" >
</div>
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


<script>
        function enquirycategory(id){
            $.ajax({
                type: 'GET',
                url: '/edit/enquiry/category/'+id,
                dataType: 'json',

                success:function(data){
                    // console.log(data)  
                    $('#category').val(data.category);
                    $('#purpose').val(data.purpose);
                    $('#whom').val(data.whom);
                    $('#category_id').val(data.id);
                  
                }

            })

        }
    </script>

	


@endsection