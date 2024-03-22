@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Payroll</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="expenses.html">Payroll</a></li>
                    <li class="breadcrumb-item active">Edit Payroll</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form id="department-form" method="post" action="{{ route('update.payroll', $payroll_data->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $payroll_data->id }}">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Payroll Information</span></h5>
                            </div>

                            <!-- Month -->
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label style="color: black;" for="inputVendor" class="form-label">Month</label>
                                    <select id="month" name="month" class="form-select">
                                        <option value="">Select month</option>
                                        <?php
                                        // Generate month options dynamically
                                        $months = [
                                            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                                            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                                            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                                        ];
                                        ?>
                                        @foreach($months as $monthNum => $monthName)
                                            <option value="{{ $monthNum }}" {{ $payroll_data->month == $monthNum ? 'selected' : '' }}>{{ $monthName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Year -->
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label style="color: black;" for="inputVendor" class="form-label">Year</label>
                                    <select id="year" name="year" class="form-select">
                                        <option value="">Select year</option>
                                        <?php
                                        // Get the current year
                                        $currentYear = date('Y');
                                        // Calculate the end year (current year + 20)
                                        $endYear = $currentYear + 20;

                                        // Generate years dynamically for the next 20 years
                                        for ($year = $currentYear; $year <= $endYear; $year++) {
                                            $selected = ($payroll_data->year == $year) ? 'selected' : '';
                                            echo "<option value=\"$year\" $selected>$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label style="color: black;" for="inputVendor" class="form-label">Department</label>
                                    <select id="department_id" name="department_id" class="form-select">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ $payroll_data->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Employee -->
                            <div class="col-12 col-sm-4">
                                <div class="form-group local-forms">
                                    <label for="employee">Employee <span class="login-danger">*</span></label>
                                    <select class="form-control" id="user_id" name="user_id">
                                        <option value="">Select Employee</option>
                                        @foreach($users as $employee)
                                            <option value="{{ $employee->id }}" {{ $payroll_data->user_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                       
                </div>
            </div>
        </div>
    </div>
</div>

<hr>










<!--ALLOWANCES-->
<div class="content container-fluid">
<div class="row">
<!-- ALLOWANCES -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">ALLOWANCES</h5>
        </div>
        <div class="card-body pt-0">
            <div class="settings-form allowances-form">
                @foreach(json_decode($payroll_data->allowances) as $index => $allowance)
                <div class="links-info">
                    <div class="row form-row links-cont">
                        <div class="form-group local-forms form-placeholder d-flex">
                            <label style="color: black;" class="form-label">Allowance Type</label>
                            <input type="text" class="form-control me-2" name="allowance_type{{ $index + 1 }}" value="{{ $allowance->type }}">
                            <input type="number" min="0" class="form-control allowance-amount" name="allowance_amount{{ $index + 1 }}" value="{{ $allowance->amount }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>






<!-- DEDUCTIONS -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">DEDUCTIONS</h5>
        </div>
        <div class="card-body pt-0">
            <div class="settings-form deductions-form">
                @foreach(json_decode($payroll_data->deductions) as $index => $deduction)
                <div class="links-info">
                    <div class="row form-row links-cont">
                        <div class="form-group local-forms form-placeholder d-flex">
                            <label style="color: black;" class="form-label">Deduction Type</label>
                            <input type="text" class="form-control me-2" name="deduction_type{{ $index + 1 }}" value="{{ $deduction->type }}">
                            <input type="text" class="form-control deduction-amount" name="deduction_amount{{ $index + 1 }}" value="{{ $deduction->amount }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



<!-- Tax -->
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h5 class="card-title">ADD PERSONAL INCOME TAX</h5>
</div>
<div class="card-body pt-0">
<div class="settings-form deductions-form">
<div class="links-info">
<div class="row form-row links-cont" id="tax-container">
<div class="form-group local-forms form-placeholder d-flex">
<label style="color: black;" for="inputVendor" class="form-label">Tax Percentage</label>
<input type="text" class="form-control me-2" id="tax_percentage" name="tax_percentage" value="{{$payroll_data->tax_percentage}}">
<span class="input-group-text" id="sizing-addon3">%</span>
<div>
<a href="#" class="btn trash delete-tax">
<i class="feather-trash-2"></i>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="form-group">
<button type="button" class="btn add-links deductions-add-link" id="add-tax">
<i class="fas fa-plus me-1"></i> Add More
</button>
</div>
</div>
</div>










<div class="content container-fluid">



<div class="row">
<div class="col-lg-8">
<div class="card">
<div class="card-header">
<h3 class="card-title">SUMMARY</h3>
</div>
<div class="card-body">


<div class="form-group row">
    <label class="col-form-label col-md-2">Basic Salary</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="starting_salary" name="starting_salary" value="{{ $payroll_data->users->starting_salary }}" readonly>
    </div>
</div>



<!-- Total Allowance -->
<div class="form-group row">
    <label class="col-form-label col-md-2">Total Allowance</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="total_allowance" name="total_allowance" value="{{$payroll_data->total_allowance}}" readonly>
    </div>
</div>

<div class="form-group row">
<label class="col-form-label col-md-2">Total Deduction</label>
<div class="col-md-10">
<input type="text" class="form-control" id="total_deduction" name="total_deduction" value="{{$payroll_data->total_deduction}}" readonly>
</div>
</div>

<!-- Net Salary -->
<div class="form-group row">
    <label class="col-form-label col-md-2">Net Salary</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="net_salary" name="net_salary" value="{{$payroll_data->net_salary}}" readonly>
    </div>
</div>


<div class="form-group row">
    <label class="col-form-label col-md-2" for="status">Status</label>
    <div class="col-md-10">
        <select class="form-control" id="status" name="status">
            <option value="{{ \App\Models\Payroll::STATUS_UNPAID }}" {{ $payroll_data->status === \App\Models\Payroll::STATUS_UNPAID ? 'selected' : '' }}>Unpaid</option>
            <option value="{{ \App\Models\Payroll::STATUS_PAID }}" {{ $payroll_data->status === \App\Models\Payroll::STATUS_PAID ? 'selected' : '' }}>Paid</option>
        </select>
    </div>
</div>



</div>
<div class="form-group mb-0 text-center">
<div class="settings-btns">
<button type="submit" class="btn btn-orange">CREATE PAYSLIP</button>

</div>
</div>
</div>
</div>
</div>
</div>

</form>









<script type="text/javascript">
  		
  		$(document).ready(function(){
    $('select[name="department_id"]').on('change', function(){
        var department_id = $(this).val();
        if (department_id) {
            $.ajax({
                type: 'GET',
                url: "{{url('/getTeacher/ajax')}}/" + department_id,
                dataType: "json",
                success:function(data){
                    var userDropdown = $('select[name="user_id"]');
                    userDropdown.html(''); // Clear existing options
                    userDropdown.append('<option value="">Select Employee</option>'); // Add default option
                    $.each(data, function(key, value){
                        userDropdown.append('<option value="'+ value.id + '">' + value.name + '</option>');
                    });
                },
            });
        } else {
            // If no department is selected, reset the employee dropdown
            $('select[name="user_id"]').html('<option value="">Select Employee</option>');
        }
    });
});

  </script>




<script type="text/javascript">
  		
  		$(document).ready(function(){
    $('select[name="user_id"]').on('change', function(){
        var user_id = $(this).val();
        if (user_id) {
            // Make AJAX call to fetch basic salary
            $.ajax({
                type: 'GET',
                url: "{{ url('/getSalary/ajax') }}/" + user_id,
                dataType: "json",
                success: function(data) {
                    // Update Basic Salary field with the received value
                    $('input[name="starting_salary"]').val(data.starting_salary);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error if necessary
                }
            });
        }
    });
});
</script>



<script>
    $(document).on('input', '.allowance-amount', function() {
    var totalAllowance = 0;
    $('.allowance-amount').each(function() {
        var amount = parseFloat($(this).val()) || 0;
        totalAllowance += amount;
    });
    $('#total_allowance').val(totalAllowance.toFixed(2)); // Update total allowance field
    updateNetSalary(); // Update net salary
});


</script>




<script>
    $(document).on('input', '.deduction-amount', function() {
    var totalDeduction = 0;
    $('.deduction-amount').each(function() {
        var amount = parseFloat($(this).val()) || 0;
        totalDeduction += amount;
    });
    $('#total_deduction').val(totalDeduction.toFixed(2)); // Update total deduction field
    updateNetSalary(); // Update net salary
});


</script>






<script>
    // Function to update hidden input field with allowances data
function updateAllowances() {
    var allowancesData = [];
    $('.allowance-amount').each(function() {
        var type = $(this).prev('input[type="text"]').val();
        var amount = $(this).val();
        allowancesData.push({ "type": type, "amount": amount });
    });
    $('#allowances').val(JSON.stringify(allowancesData));
}

// Function to update hidden input field with deductions data
function updateDeductions() {
    var deductionsData = [];
    $('.deduction-amount').each(function() {
        var type = $(this).prev('input[type="text"]').val();
        var amount = $(this).val();
        deductionsData.push({ "type": type, "amount": amount });
    });
    $('#deductions').val(JSON.stringify(deductionsData));
}

// Call these functions whenever an allowance or deduction is added or changed
$(document).on('input', '.allowance-amount', updateAllowances);
$(document).on('input', '.deduction-amount', updateDeductions);

</script>





<script>

$(document).ready(function() {
    // Set the decimal separator to dot
Number.prototype.toLocaleString = function () {
    return this.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
};

// Function to update net salary
function updateNetSalary() {
    var basicSalaryStr = $('#starting_salary').val().replace(',', ''); // Remove commas from the string
    var basicSalary = parseFloat(basicSalaryStr) || 0; // Convert to float, defaulting to 0 if conversion fails
    var totalAllowance = parseFloat($('#total_allowance').val().replace(',', '.')) || 0; // Replace commas with dots for consistency
    var totalDeduction = parseFloat($('#total_deduction').val().replace(',', '.')) || 0; // Replace commas with dots for consistency
    var netSalary = basicSalary + totalAllowance - totalDeduction;
    $('#net_salary').val(netSalary.toLocaleString()); // Format net salary for display
}

    // Trigger net salary update when an employee is selected
    $('select[name="user_id"]').on('change', function() {
        // Make AJAX call to fetch basic salary
        var user_id = $(this).val();
        if (user_id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('/getSalary/ajax') }}/" + user_id,
                dataType: "json",
                success: function(data) {
                    // Update Basic Salary field with the received value
                    $('input[name="starting_salary"]').val(data.starting_salary);
                    updateNetSalary(); // Update net salary
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error if necessary
                }
            });
        }
    });

    // Trigger net salary update when allowances or deductions change
    $(document).on('input', '.allowance-amount, .deduction-amount', function() {
        updateNetSalary(); // Update net salary
    });
});


</script>


<script>

// Function to update net salary
// Function to update net salary
function updateNetSalary() {
    var basicSalary = parseFloat($('#starting_salary').val().replace(',', '')) || 0; // Remove commas and convert to float
    var totalAllowance = parseFloat($('#total_allowance').val().replace(',', '.')) || 0; // Replace commas with dots for consistency
    var totalDeduction = parseFloat($('#total_deduction').val().replace(',', '.')) || 0; // Replace commas with dots for consistency
    var taxPercentage = parseFloat($('#tax_percentage').val()) || 0; // Get tax percentage
    
    // Calculate net salary before tax
    var netSalaryBeforeTax = basicSalary + totalAllowance - totalDeduction;
    
    // Calculate total tax amount
    var totalTaxAmount = (netSalaryBeforeTax * (taxPercentage / 100)).toFixed(2);
    
    // Calculate net salary after tax deduction
    var netSalaryAfterTax = netSalaryBeforeTax - totalTaxAmount;
    
    // Update net salary input field with the calculated value
    $('#net_salary').val(netSalaryAfterTax.toLocaleString()); // Format net salary for display
}

// Trigger net salary update when allowances, deductions, or tax percentage change
$(document).on('input', '.allowance-amount, .deduction-amount, #tax_percentage', function() {
    updateNetSalary(); // Update net salary
});

// Trigger net salary update when the employee selection changes
$('#user_id').on('change', function() {
    // Trigger net salary update
    updateNetSalary();
});



</script>



@endsection