@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE EXPENSES</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">ALL EXPENSES </li>
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
<a href="{{ route('add.payroll') }}" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD EXPENSES </a>
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
<th>Employee Name</th>
<th>Summary</th>
<th>Date</th>
<th>Status</th>


<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($all_payroll as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $item->users->name }}</td>
<td>
<strong>Basic Salary::</strong> {{ $item->users->starting_salary }}<br>
<strong>Total-Allowances::</strong> {{ $item->total_allowance }}<br>
<strong>Total-Deductions::</strong> {{ $item->total_deduction }}<br>
<strong>Tax-Percentage::</strong> {{ $item->tax_percentage }}%<br>
<strong>Net Salary::</strong> {{ $item->net_salary }}
</td>
<td>{{ DateTime::createFromFormat('!m', $item->month)->format('F') }} - {{ $item->year }}</td>
@if ($item->status == 'unpaid')
<td><button type="button" class="btn btn-rounded btn-danger">{{ $item->status }}</button></td>
@else
<td><button type="button" class="btn btn-rounded btn-primary">{{ $item->status }}</button></td>
@endif


<td class="text-end">
<div class="actions">


<a href="{{ route('payroll.detail', $item->id) }}" class="btn btn-sm text-success bg-success-light me-2" >
    <i class="feather-eye"></i>
</a>


<a href="{{ route('payroll.edit', $item->id) }}" class="btn btn-sm text-success bg-success-light me-2" >
    <i class="feather-edit"></i>
</a>

<!---@if($item->status === 'unpaid')
<form action="{{ route('update.paid', $item->id) }}" method="POST">
@csrf
<button type="submit" class="btn btn-success">Mark as Paid</button>
</form>
@else
<form action="{{ route('update.unpaid', $item->id) }}" method="POST">
@csrf
<button type="submit" class="btn btn-warning">Mark as Unpaid</button>
</form>
@endif--->


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