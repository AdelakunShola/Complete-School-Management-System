@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
    th {
    font-weight: normal;
}
    </style>

<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">MANAGE DRIVERS</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">DRIVERS</li>
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
<a href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i> ADD DRIVERS </a>
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
<th>Licence</th>
<th>Driver Name</th>
<th>Number</th>
<th>Address</th>
<th>License Expiry Date</th>
<th>License Number</th>
<th>Status</th>


<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@foreach ($driver as $key=> $item ) 
<tr>
<td>{{ $key+1 }}</td>
<td> <img src="{{ asset($item->license) }}" style="width: 50px; height:50px;" >  </td>
<th>{{$item->driver_name}}</th>
<th>{{$item->phone}}</th>
<th>{{$item->address}}</th>
<th>{{$item->license_expiry_date}}</th>
<th>{{$item->license_number}}</th>
<th>{{$item->status}}</th>

<td class="text-end">
<div class="actions">

<a href="{{ route('edit.driver', $item->id) }}" class="btn btn-sm text-primary" ><i class="feather-edit"></i>
<a href="#" class="btn btn-sm text-danger" onclick="confirmDelete('{{ route('delete.driver', $item->id) }}')">
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




<!-- ADD VEHICLE --->

<div id="con-close-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">




<div class="col-md-12">
<div class="card">
<div class="card-header">
<h5 class="card-title">ADD DRIVER</h5>
</div>
<div class="card-body pt-0">

<div class="settings-form deductions-form">



<form method="post" action="{{ route('store.driver') }}" enctype="multipart/form-data">
@csrf

<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Driver</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body p-12">

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Driver Name</label>
<input type="text" class="form-control" id="driver_name" name="driver_name"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Phone No.</label>
<input type="text" class="form-control" id="phone" name="phone"  >
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Address</label>
<input type="text" class="form-control" id="address" name="address"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label"> License Number</label>
<input type="text" class="form-control" id="license_number" name="license_number"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3 calendar-icon">
<label for="field-1" class="form-label"> License Expiry Date</label>
<input type="text" class="form-control datetimepicker" id="license_expiry_date" name="license_expiry_date" placeholder="29-04-2022" >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">guarantor_name</label>
<input type="text" class="form-control" id="guarantor_name" name="guarantor_name"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">guarantor_phone</label>
<input type="text" class="form-control" id="guarantor_phone" name="guarantor_phone"  >
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="mb-3">
<label for="field-1" class="form-label">Guarantor Address</label>
<input type="text" class="form-control" id="guarantor_phone" name="guarantor_address"  >
</div>
</div>
</div>


<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Upload Your License </label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="image" name="license">
</label>
</div>
<img id="showImage" src="" alt="Admin"style="width: 100px; height:100px;" >
</div>
</div>





<div class="col-12 col-sm-4">
<div class="form-group students-up-files">
<label>Guarantor's ID card</label>
<div class="uplod">
<label class="file-upload image-upbtn mb-0">
Choose File <input type="file" id="images" name="guarantor_id_card">
</label>
</div>
<img id="showImages" src="" alt="Admin"style="width: 100px; height:100px;" >
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
</div>
</div>
</div>
</div>






<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#images').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImages').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#imagess').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImagess').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#imag').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImag').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#edit-image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showEditImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#edit-guarantor-id-card').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showEditGuarantorIdCard').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>



<script>
function driver(id){
$.ajax({
type: 'GET',
url: '/edit/driver/'+id,
dataType: 'json',

success:function(data){
// console.log(data)  
$('#edit-name').val(data.name);
$('#edit-driver_name').val(data.driver_name);
$('#edit-phone').val(data.phone);
$('#edit-address').val(data.address);
$('#edit-license_expiry_date').val(data.license_expiry_date);
$('#edit-license_number').val(data.license_number);
$('#edit-guarantor_name').val(data.guarantor_name);
$('#edit-guarantor_phone').val(data.guarantor_phone);
$('#edit-license').val(data.license);
$('#edit-guarantor_id_card').val(data.guarantor_id_card);
$('#driver_id').val(data.id);
}
});
}

</script>




@endsection