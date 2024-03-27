<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Dashboard</title>

<link rel="shortcut icon" href="assets/img/favicon.png">


<link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('backend/assets/plugins/feather/feather.css')}}">

<link rel="stylesheet" href="{{asset('backend/assets/plugins/icons/flags/flags.css')}}">

<link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/plugins/fontawesome/css/all.min.css')}}">

<link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">

<!-- DataTable -->
<link href="{{asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
<!-- DataTable-->

<!--<link rel="stylesheet" href="{{asset('backend/assets/plugins/select2/css/select2.min.css')}}">--->

<!-- Bootstrap Datepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

<!--<link rel="stylesheet" href="{{asset('backend/assets/plugins/datatables/datatables.min.css')}}">--->

<style>
    
</style>


</head>
<body>




<div class="content container-fluid">
<div class="row justify-content-center">
<div class="col-xl-10">
<div class="card invoice-info-card">
<div class="card-body">
<div class="invoice-item invoice-item-one">
<div class="row">
<div class="col-md-6">

<div class="invoice-logo">
<img src="{{ asset($setting->logo) }}" alt="logo">
</div>
<div class="invoice-head">
<h2>PAYSLIP</h2>
<p>Payslip Number : {{ $payroll_id->payroll_code }}</p>
</div>
</div>
<div class="col-md-6">
<div class="invoice-info">
<strong class="customer-text-one">Payslip From</strong>
<h6 class="invoice-name">{{ $setting->school_name }}</h6>
<p class="invoice-details">
9087484288 <br>
{{ $setting->address }}<br>
{{ $setting->postal_code }} ,{{ $setting->city }} - {{ $setting->state }} <br> {{ $setting->country }}
</p>
</div>
</div>
</div>
</div>


<div class="invoice-item invoice-item-two">
<div class="row">
<div class="col-md-6">
<div class="invoice-info">

    <h5><strong>Employee Name::</strong></h5>  {{ $payroll_id->users->name }}

    <h5><strong >Department ::</strong></h5>  {{ $payroll_id->department->name }}

    <h5><strong >Designation ::</strong></h5>  {{ $payroll_id->designation->designation_name }}

    <h5><strong>Date of Joining ::</strong></h5>  {{ $payroll_id->users->employment_date }}

<p class="invoice-details invoice-details-two">
{{ $payroll_id->users->phone }} <br>
{{ $payroll_id->users->address }} <br>
{{ $payroll_id->users->zipcode }} ,{{ $payroll_id->users->state }} - {{ $payroll_id->users->country }}
</p>
</div>
</div>
<div class="col-md-6">
<div class="invoice-info invoice-info2">
<strong class="customer-text-one">Payment Details</strong>
<p class="invoice-details">
Account Details<br>
 account_number   <br>
 bank_name 
</p>
<div class="invoice-item-box">
<p>Recurring : 15 Months</p>
<p class="mb-0">PO Number : 54515454</p>
</div>
</div>
</div>
</div>
</div>


<div class="invoice-issues-box">
<div class="row">
<div class="col-lg-4 col-md-4">
<div class="invoice-issues-date">
<p>Issue Date : {{ DateTime::createFromFormat('!m', $payroll_id->month)->format('F') }} - {{ $payroll_id->year }}</p>
</div>
</div>
<div class="col-lg-4 col-md-4">
<div class="invoice-issues-date">
<p></p>
</div>
</div>
<div class="col-lg-4 col-md-4">
<div class="invoice-issues-date">
<p>Due Amount : {{ $payroll_id->net_salary }} </p>
</div>
</div>
</div>
</div>


<div class="invoice-item invoice-table-wrap">
<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="invoice-table table table-center mb-0">
<thead>
<tr>
<th>Basic Salary</th>
<th>Allowances</th>
<th>Deduction</th>
<th>Tax(%)</th>

</tr>
</thead>
<tbody>
<tr>
<td>{{ $payroll_id->users->starting_salary }}</td>
<td><pre>{{ json_encode(json_decode($payroll_id->allowances), JSON_PRETTY_PRINT) }}</pre></td>
<td><pre>{{ json_encode(json_decode($payroll_id->deductions), JSON_PRETTY_PRINT) }}</pre></td>
<th>{{ $payroll_id->tax_percentage }}%</th>
</tr>


</tbody>
</table>
</div>
</div>
</div>
</div>

<div class="row align-items-center justify-content-center">
<div class="col-lg-6 col-md-6">
<div class="invoice-terms">
<h6>Notes:</h6>
<p class="mb-0">Enter customer notes or any other details</p>
</div>
<div class="invoice-terms">
<h6>Terms and Conditions:</h6>
<p class="mb-0">Enter customer notes or any other details</p>
</div>
</div>
<div class="col-lg-6 col-md-6">
<div class="invoice-total-card">
<div class="invoice-total-box">
<div class="invoice-total-inner">
<p>Basic Salary <span>{{ $payroll_id->users->starting_salary }}</span></p>
<p>Allowances <span>{{ $payroll_id->total_allowance }}</span></p>
<p>Deductions  <span>{{ $payroll_id->total_deduction }}</span></p>
<p>Tax% <span>{{ $payroll_id->tax_percentage }}%</span></p>
</div>
<div class="invoice-total-footer">
<h4>Total Amount <span>{{ $payroll_id->net_salary }}</span></h4>
</div>
</div>
</div>
</div>
</div>
<div class="invoice-sign text-end">
<img class="img-fluid d-inline-block" src="assets/img/signature.png" alt="sign">
<span class="d-block">Harristemp</span>
</div>

<button style="width: 10%;" class="btn btn-primary" onclick="printPage()">Print</button> / 
<a style="width: 15%;" href="{{ route('view.payroll', $payroll_id->id) }}" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-primary me-2" id="downloadLink">download </a>

</div>
</div>
</div>
</div>
</div>



<script>
function printPage() {
    window.print(); // Trigger the browser's print functionality
}
</script>



<!-- Add an id attribute to the download link -->

<!-- JavaScript code to handle the download functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the download link element
    var downloadLink = document.getElementById('downloadLink');

    // Add a click event listener to the download link
    downloadLink.addEventListener('click', function(event) {
        // Prevent the default behavior of the link
        event.preventDefault();

        // Get the HTML content of the current page
        var htmlContent = document.documentElement.outerHTML;

        // Create a new Blob from the HTML content
        var blob = new Blob([htmlContent], { type: 'text/html' });

        // Create a temporary URL for the Blob
        var url = window.URL.createObjectURL(blob);

        // Create a new anchor element
        var anchor = document.createElement('a');

        // Set the href attribute of the anchor to the URL of the Blob
        anchor.href = url;

        // Set the download attribute of the anchor to the desired filename for the downloaded file
        anchor.download = 'page.html';

        // Append the anchor element to the document body
        document.body.appendChild(anchor);

        // Trigger a click event on the anchor element to start the download
        anchor.click();

        // Remove the anchor element from the document body after the download starts
        document.body.removeChild(anchor);

        // Revoke the temporary URL to free up memory
        window.URL.revokeObjectURL(url);
    });
});
</script>


</body>


</html>
