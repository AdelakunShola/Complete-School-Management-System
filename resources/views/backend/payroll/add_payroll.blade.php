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

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form id="department-form" method="post" action="{{ route('store.payroll') }}" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Payroll Information</span></h5>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label style="color: black;" for="inputVendor" class="form-label">Month</label>
<select id="month" name="month" class="form-select" >
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
<option value="{{ $monthNum }}">{{ $monthName }}</option>
@endforeach
</select>
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label style="color: black;" for="inputVendor" class="form-label">Year</label>
<select id="year" name="year" class="form-select" >
<option value="">Select year</option>
<?php
// Get the current year
$currentYear = date('Y');
// Calculate the end year (current year + 20)
$endYear = $currentYear + 20;

// Generate years dynamically for the next 20 years
for ($year = $currentYear; $year <= $endYear; $year++) {
echo "<option value=\"$year\">$year</option>";
}
?>
</select>
</div>
</div>



<div class="col-12 col-sm-4">
<div class="form-group local-forms">
<label style="color: black;" for="inputVendor" class="form-label">Department</label>
<select id="department_id" name="department_id" class="form-select" >
<option value="">Select Department</option>
@foreach($departments as $department)
    <option value="{{ $department->id }}">{{ $department->name }}</option>
@endforeach
</select>
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group local-forms">
    <label for="employee">Employee <span class="login-danger">*</span></label>
    <select class="form-control" id="user_id" name="user_id">
        <option value="">Select Employee</option>
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
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h5 class="card-title">ADD ALLOWANCES</h5>
</div>
<div class="card-body pt-0">
<div class="settings-form allowances-form">
<div class="links-info">
<div class="row form-row links-cont" id="allowances-container">
<div class="form-group local-forms form-placeholder d-flex">
<label style="color: black;" for="inputVendor" class="form-label">Allowance Type</label>
<input type="text" class="form-control me-2" name="allowance_type[]" placeholder="Allowance type">
<input type="number" min="0" class="form-control allowance-amount" name="allowance_amount[]" placeholder="Allowance Amount">
<div>
<a href="#" class="btn trash delete-allowance">
<i class="feather-trash-2"></i>
</a>
</div>
</div>
</div>
</div>
</div>
<div class="form-group">
<button type="button" class="btn add-links allowances-add-link" id="add-allowance">
<i class="fas fa-plus me-1"></i> Add More
</button>
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
                                <input type="text" class="form-control me-2" name="deduction_type[]" placeholder="Deduction type">
                                <input type="number" min="0" class="form-control deduction-amount" name="deduction_amount[]" placeholder="Deduction Amount">
                                <div>
                                    <a href="#" class="btn trash delete-deduction">
                                        <i class="feather-trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="button" class="btn add-links deductions-add-link" id="add-deduction">
                        <i class="fas fa-plus me-1"></i> Add More
                    </button>
                </div>
               
           
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
        <input type="text" class="form-control" id="starting_salary" name="starting_salary" readonly>
    </div>
</div>


<!-- Total Allowance -->
<div class="form-group row">
    <label class="col-form-label col-md-2">Total Allowance</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="total_allowance" name="total_allowance" readonly>
    </div>
</div>

<div class="form-group row">
<label class="col-form-label col-md-2">Total Deduction</label>
<div class="col-md-10">
<input type="text" class="form-control" id="total_deduction" name="total_deduction" readonly>
</div>
</div>

<!-- Net Salary -->
<div class="form-group row">
    <label class="col-form-label col-md-2">Net Salary</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="net_salary" name="net_salary" readonly>
    </div>
</div>


<div class="form-group row">
    <label class="col-form-label col-md-2" for="status">Status</label>
    <div class="col-md-10">
        <select class="form-control" id="status" name="status">
            <option value="{{ \App\Models\Payroll::STATUS_UNPAID }}">Unpaid</option>
            <option value="{{ \App\Models\Payroll::STATUS_PAID }}">Paid</option>
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







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script type="text/javascript">
  		
  		$(document).ready(function(){
  			$('select[name="department_id"]').on('change', function(){
  				var department_id = $(this).val();
  				if (department_id) {
  					$.ajax({
                        type: 'GET',
                        url: "{{url('/getTeacher/ajax')}}/" + department_id,
  						dataType:"json",
  						success:function(data){
  							$('select[name="user_id"]').html('');
  							var d =$('select[name="user_id"]').empty();
  							$.each(data, function(key, value){
  								$('select[name="user_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
  							});
  						},
  					});
  				} else {
  					alert('danger');
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
$(document).ready(function() {
    // Counter to keep track of the number of allowance input fields
    var allowanceCounter = 1;

    // Trigger calculation of total allowance on page load
    calculateAndDisplayTotalAllowance();

    // Add More button click event handler
    $('#add-allowance').click(function() {
        // Increment the counter
        allowanceCounter++;

        // HTML code for new allowance input fields
        var newAllowanceField = `
            <div class="form-group local-forms form-placeholder d-flex">
                <label style="color: black;" for="inputVendor" class="form-label">Allowance Type</label>
                <input type="text" class="form-control me-2" name="allowance_type[]" placeholder="Allowance type">
                <input type="number" min="0" class="form-control allowance-amount" name="allowance_amount[]" placeholder="Allowance Amount">
                <div>
                    <a href="#" class="btn trash delete-allowance">
                        <i class="feather-trash-2"></i>
                    </a>
                </div>
            </div>`;

        // Append the new allowance input fields to the container
        $('#allowances-container').append(newAllowanceField);
        calculateAndDisplayTotalAllowance(); // Recalculate total allowance
    });

    // Calculate total allowance when typing allowance amount
    $(document).on('input', '.allowance-amount', function() {
        calculateAndDisplayTotalAllowance();
    });

    // Delete allowance event handler
    $(document).on('click', '.delete-allowance', function(event) {
    event.preventDefault(); // Prevent default action of anchor tag
    $(this).closest('.form-group.local-forms').remove(); // Remove the allowance field
    calculateAndDisplayTotalAllowance(); // Recalculate total allowance
});

// Delete allowance event handler
$(document).on('click', '.delete-allowance', function(event) {
    event.preventDefault(); // Prevent default action of anchor tag
    $(this).closest('.form-group.local-forms').remove(); // Remove the allowance field
    calculateAndDisplayTotalAllowance(); // Recalculate total allowance
});


    // Function to calculate and display total allowance
    function calculateAndDisplayTotalAllowance() {
        var totalAllowance = 0;
        $('.allowance-amount').each(function() {
            var amount = parseFloat($(this).val());
            if (!isNaN(amount)) {
                totalAllowance += amount;
            }
        });
        $('#total_allowance').val(totalAllowance.toFixed(2));
    }
});


</script>


<script>
$(document).ready(function() {
    // Counter to keep track of the number of deduction input fields
    var deductionCounter = 1;

    // Trigger calculation of total deduction on page load
    calculateAndDisplayTotalDeduction();

    // Add More button click event handler for deductions
    $('#add-deduction').click(function() {
        // Increment the counter
        deductionCounter++;

        // HTML code for new deduction input fields
        var newDeductionField = `
            <div class="form-group local-forms form-placeholder d-flex">
                <label style="color: black;" for="inputVendor" class="form-label">Deduction Type</label>
                <input type="text" class="form-control me-2" name="deduction_type[]" placeholder="Deduction type">
                <input type="number" min="0" class="form-control deduction-amount" name="deduction_amount[]" placeholder="Deduction Amount">
                <div>
                    <a href="#" class="btn trash delete-deduction">
                        <i class="feather-trash-2"></i>
                    </a>
                </div>
            </div>`;

        // Append the new deduction input fields to the container
        $('#deductions-container').append(newDeductionField);
        calculateAndDisplayTotalDeduction(); // Recalculate total deduction
    });

    // Calculate total deduction when typing deduction amount
    $(document).on('input', '.deduction-amount', function() {
        calculateAndDisplayTotalDeduction();
    });

    // Delete deduction event handler
    $(document).on('click', '.delete-deduction', function(event) {
        event.preventDefault(); // Prevent default action of anchor tag
        $(this).closest('.form-group.local-forms').remove(); // Remove the deduction field
        calculateAndDisplayTotalDeduction(); // Recalculate total deduction
    });

    // Function to calculate and display total deduction
    function calculateAndDisplayTotalDeduction() {
        var totalDeduction = 0;
        $('.deduction-amount').each(function() {
            var amount = parseFloat($(this).val());
            if (!isNaN(amount)) {
                totalDeduction += amount;
            }
        });
        $('#total_deduction').val(totalDeduction.toFixed(2));
    }
});


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


@endsection