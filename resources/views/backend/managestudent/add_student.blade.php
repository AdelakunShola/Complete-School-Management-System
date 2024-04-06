@extends('admin.admin_dashboard')
@section('admin')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style>
    .select2-container .select2-selection--single{
    height:41px !important;
}
.select2-container--default .select2-selection--single{
         border: 1px solid #ccc !important; 
         border-radius: 5px !important; 
}

</style>
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Add Payroll</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="expenses.html">Payroll</a></li>
<li class="breadcrumb-item active">Add Payroll</li>
</ul>
</div>
</div>
</div>


</div>
<hr>










<!--ALLOWANCES-->
<div class="content container-fluid">
<div class="row">
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h5 class="card-title">ADD ALLOWANCES</h5>
</div>
<div class="card-body pt-0">
<div class="settings-form allowances-form">





<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Image</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Full Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row mb-4">
<div class="col-md-12">
<div class="mb-3 position-relative">
<label for="field-1" class="form-label">Parent</label>
<div class="d-flex align-items-center">
<select id="parentSelect" class="select2 form-control">
<option selected="selected">Select</option>
<option value="search" data-toggle="search">Search...</option>
<option value="California">California</option>
<option value="Tasmania">Tasmania</option>
<option value="Auckland">Auckland</option>
<option value="Marlborough">Marlborough</option>
</select>
<div id="searchDropdown" class="dropdown-menu p-3" style="display: none;">
<input type="text" id="searchInput" class="form-control mb-2" placeholder="Search...">
</div>
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px;"></i>
</span>
</a>
</div>
</div>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div class="mb-3 position-relative">
<label for="field-1" class="form-label">Class</label>
<div class="d-flex align-items-center">
<input type="text" class="form-control" id="name" name="name">
<a href="#">
<span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
<i class="fas fa-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px; "></i>
</span>
</a>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

</div>

</div>
</div>
</div>







<!-- DEDUCTIONS -->
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h5 class="card-title">ADD DEDUCTIONS</h5>
</div>
<div class="card-body pt-0">

<div class="settings-form deductions-form">



<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Student Category Name</label>
<input type="text" class="form-control" id="name" name="name"  >
</div>
</div>
</div>




</div>

</div>
</div>
</div>

















</form>


<script>
    $('.select2').select2();
</script>

@endsection