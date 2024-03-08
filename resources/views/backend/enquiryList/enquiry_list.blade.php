@extends('admin.admin_dashboard')
@section('admin')
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">ENQUIRY LIST</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">ENQUIRY LIST</li>
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
<button class="btn btn-outline-primary me-2">ENQUIRY LIST</button>
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
<th>Phone No</th>
<th>Purpose</th>
<th>Name</th>
<th>Whom-To-Meet</th>
<th>Email</th>
<th>Content</th>
<th>Date Submitted</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($enquiry_list as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->category }}</td>
<td>{{ $item->mobile }}</td>
<td>{{ $item->purpose }}</td>
<td>{{ $item->name }}</td>
<td>{{ $item->whom_to_meet }}</td>
<td>{{ $item->email }}</td>
<td>{{ Str::limit($item->content, 40) }}</td>
<td>{{ $item->created_at->format('d M Y H:i:s') }}</td>


<td class="text-end">
<div class="actions">

<button type="button" class="btn btn-sm text-success bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#con-close-modal" id="{{ $item->id }}" onclick="enquirylist(this.id)"><i class="feather-eye"></i></button>


<a class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.enquiry.list', $item->id) }}')">
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




<!-- EDIT ENQUIRY CATEGORY --->

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">

<input  type="hidden" name="category_id" id="category_id" >
<input  type="hidden" name="mobile_id" id="mobile_id" >
<input  type="hidden" name="purpose_id" id="purpose_id" >
<input  type="hidden" name="whom_id" id="whom_id" >

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">View Enquiry</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">CATEGORY</label>
<input type="text" class="form-control" id="category" name="category"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">MOBILE</label>
<input type="text" class="form-control" id="mobile" name="mobile"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">PURPOSE</label>
<input type="text" class="form-control" id="purpose" name="purpose" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">NAME</label>
<input type="text" class="form-control" id="name" name="name" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-3" class="form-label">WHOM TO MEET</label>
<input type="text" class="form-control" id="whom_to_meet" name="whom_to_meet" >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-3" class="form-label">EMAIL</label>
<input type="text" class="form-control" id="email" name="email" >
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
<div class="mb-3">
<label for="field-3" class="form-label">Date Submitted</label>
<input type="text" class="form-control" id="created_at->format('d M Y H:i:s')" name="created_at" value="{{ $item->created_at->format('d M Y H:i:s') }}">
</div>
</div>
</div>




</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<script>
        function enquirylist(id){
            $.ajax({
                type: 'GET',
                url: '/view/enquiry/list/'+id,
                dataType: 'json',

                success:function(data){
                    // console.log(data)  
                    $('#category').val(data.category);
                    $('#purpose').val(data.purpose);
                    $('#whom_to_meet').val(data.whom_to_meet);
                    $('#mobile').val(data.mobile);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#content').val(data.content);
                    $('#created_at').val(data.created_at);         
                    $('#category_id').val(data.id);
                  
                }

            })

        }
    </script>




@endsection