@extends('admin.admin_dashboard')
@section('admin')

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Edit Expenses</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="expenses.html">Accounts</a></li>
<li class="breadcrumb-item active">Edit Expenses</li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form id="department-form" method="post" action="{{ route('update.expense') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{ $editData->id }}">
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Expense Information</span></h5>
</div>

<div class="col-12 col-sm-4">
<label for="inputVendor" class="form-label">Category Name</label>
<select name="category_id" class="form-select" id="inputVendor">
<option></option>
@foreach($category as $cat)
<option value="{{ $cat->id }}" {{ $cat->id == $editData->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
@endforeach
</select>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Item Name <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="item_name" value="{{ $editData->item_name }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Item Quantity <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="quantity" value="{{ $editData->quantity }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Expense Amount <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="amount" value="{{ $editData->amount }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Purchased Date <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="purchase_date" value="{{ $editData->purchase_date }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Description <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="description" value="{{ $editData->description }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Method <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="method" value="{{ $editData->method }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Payment Type <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="payment_type" value="{{ $editData->payment_type }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Purchased by <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="purchase_by" value="{{ $editData->purchase_by }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Student ID<span class="login-danger">*</span></label>
<input type="text" class="form-control" name="student_id" value="{{ $editData->student_id }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Invoice ID<span class="login-danger">*</span></label>
<input type="text" class="form-control" name="invoice_id" value="{{ $editData->invoice_id }}">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Discount<span class="login-danger">*</span></label>
<input type="text" class="form-control" name="discount" value="{{ $editData->discount }}">
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


@endsection