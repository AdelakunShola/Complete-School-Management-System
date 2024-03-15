@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE AWARDS</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">AWARDS</li>
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
<a href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD AWARD </a>
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
<th>Award Code</th>
<th>Award Name</th>
<th>Gift</th>
<th>Amount</th>
<th>Date</th>
<th>Employee</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($manage_award as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->award_code }}</td>
<td>{{ $item->name }}</td>
<td>{{ $item->gift }}</td>
<td>{{ $item->amount }}</td>
<td>{{ $item->date }}</td>
<td>{{ $item->employee_id }}</td>

<td class="text-end">
<div class="actions">
<button type="button" class="btn btn-sm text-success bg-success-light me-2" data-bs-toggle="modal" data-bs-target="#con-close-modal" id="{{ $item->id }}" onclick="award(this.id)"><i class="feather-edit"></i></button>


<a href="#" class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.award', $item->id) }}')">
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

<form method="post" action="{{ route('store.award') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Award</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-4">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">AWARD NAME</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">GIFT</label>
<input type="text" class="form-control" id="club_name" name="gift"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">AMOUNT</label>
<input type="text" class="form-control" id="club_name" name="amount"  >
</div>
</div>
</div>



<br><br>
<div class="row">
<div class="col-md-12">
<div class="mb-3 form-group local-forms calendar-icon">
<label for="field-1" class="login-danger form-label">DATE</label>
<input class="form-control datetimepicker" type="text" id="club_name" name="date" placeholder="29-04-2022">
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">AMOUNT</label>
<input type="text" class="form-control" id="description" name="employee_id"  >
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
        <form method="post" action="{{ route('update.award') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="name_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Award</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    
<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">AWARD NAME</label>
<input type="text" class="form-control" id="edit-name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">GIFT</label>
<input type="text" class="form-control" id="edit-gift" name="gift"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">AMOUNT</label>
<input type="text" class="form-control" id="edit-amount" name="amount"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3 form-group local-forms calendar-icon">
<label for="field-1" class="login-danger form-label">CIRCULAR DATE</label>
<input class="form-control datetimepicker" type="text" id="edit-date" name="date" placeholder="29-04-2022">
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">EMPLOYEE</label>
<input type="text" class="form-control" id="edit-employee_id" name="employee_id"  >
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



<script>
        function award(id){
    $.ajax({
        type: 'GET',
        url: '/edit/award/'+id,
        dataType: 'json',

        success:function(data){
            // console.log(data)  
            $('#edit-name').val(data.name);
            $('#edit-gift').val(data.gift);
            $('#edit-date').val(data.date);
            $('#edit-employee_id').val(data.employee_id);
            $('#edit-amount').val(data.amount);
            $('#name_id').val(data.id);
        }
    });
}

    </script>




@endsection