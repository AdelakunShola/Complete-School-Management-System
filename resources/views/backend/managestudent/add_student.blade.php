@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
        <div class="mb-3 position-relative">
            <label for="field-1" class="form-label">Student Category Name</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="name" name="name">
                <a href="#">
                    <span class="position-absolute bottom-0 start-0 rounded-circle" style="background-color: blue; ">
                        <i class="fe fe-plus" style="color: white; font-size: 12px;"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="mb-3 position-relative">
            <label for="field-1" class="form-label">Student Category Name</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" id="name" name="name">
                <a href="#">
                    <span class="position-absolute bottom-0 start-0 rounded-pill" style="background-color: blue;  transform: translate(-30%, 90%);  width: 20px; height: 20px;">
                        <i class="fas fe-plus" style="color: white; font-size: 12px; padding-left: 5px;  padding-top: -30px; "></i>
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

<div class="links-info">
<div class="row form-row links-cont" id="deductions-container">
<div class="form-group local-forms form-placeholder d-flex">
<label style="color: black;" for="inputVendor" class="form-label">Deduction Type</label>
<input type="text" class="form-control me-2" name="deduction_type1" placeholder="Deduction type">
<input type="number" min="0" class="form-control deduction-amount" name="deduction_amount1" placeholder="Deduction Amount">
<div>
<a href="#" class="btn trash delete-deduction">
<i class="feather-trash-2"></i>
</a>
</div>
</div>
</div>
</div>

<div class="links-info">
<div class="row form-row links-cont" id="deductions-container">
<div class="form-group local-forms form-placeholder d-flex">
<label style="color: black;" for="inputVendor" class="form-label">Deduction Type</label>
<input type="text" class="form-control me-2" name="deduction_type2" placeholder="Deduction type">
<input type="number" min="0" class="form-control deduction-amount" name="deduction_amount2" placeholder="Deduction Amount">
<div>
<a href="#" class="btn trash delete-deduction">
<i class="feather-trash-2"></i>
</a>
</div>
</div>
</div>
</div>

<div class="links-info">
<div class="row form-row links-cont" id="deductions-container">
<div class="form-group local-forms form-placeholder d-flex">
<label style="color: black;" for="inputVendor" class="form-label">Deduction Type</label>
<input type="text" class="form-control me-2" name="deduction_type3" placeholder="Deduction type">
<input type="number" min="0" class="form-control deduction-amount" name="deduction_amount3" placeholder="Deduction Amount">
<div>
<a href="#" class="btn trash delete-deduction">
<i class="feather-trash-2"></i>
</a>
</div>
</div>
</div>
</div>

<div class="links-info">
<div class="row form-row links-cont" id="deductions-container">
<div class="form-group local-forms form-placeholder d-flex">
<label style="color: black;" for="inputVendor" class="form-label">Deduction Type</label>
<input type="text" class="form-control me-2" name="deduction_type4" placeholder="Deduction type">
<input type="number" min="0" class="form-control deduction-amount" name="deduction_amount4" placeholder="Deduction Amount">
<div>
<a href="#" class="btn trash delete-deduction">
<i class="feather-trash-2"></i>
</a>
</div>
</div>
</div>
</div>

</div>

</div>
</div>
</div>

















</form>



@endsection