@extends('admin.admin_dashboard')
@section('admin')

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Add Expenses</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="expenses.html">Accounts</a></li>
<li class="breadcrumb-item active">Add Expenses</li>
</ul>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form id="department-form" method="post" action="{{ route('store.expense') }}" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Expense Information</span></h5>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label for="inputVendor" class="form-label">Category Name</label>
<select name="category_id" class="form-select" id="inputVendor">
<option></option>
@foreach($category as $cat)
<option value="{{ $cat->id }}">{{ $cat->name }}</option>
@endforeach
</select>
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Item Name <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="item_name">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Item Quality <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="quality">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Expense Amount <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="amount">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Purchased Date <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="purchase_date">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Description <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="description">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Method <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="method">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Payment Type <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="payment_type">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Purchased by <span class="login-danger">*</span></label>
<input type="text" class="form-control" name="purchase_by">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Student ID<span class="login-danger">*</span></label>
<input type="text" class="form-control" name="student_id">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Invoice ID<span class="login-danger">*</span></label>
<input type="text" class="form-control" name="invoice_id">
</div>
</div>
<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label>Discount<span class="login-danger">*</span></label>
<input type="text" class="form-control" name="discount">
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