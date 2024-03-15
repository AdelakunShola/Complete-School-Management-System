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




</head>
<body>

<div class="main-wrapper">

@include('admin.body.header')


@include('admin.body.sidebar')


<div class="page-wrapper">

@yield('admin')


@include('admin.body.footer')

</div>

</div>


<script src="{{asset('backend/assets/js/jquery-3.7.1.min.js')}}" type="530567ed2bd147a057bef500-text/javascript"></script>

<script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}" type="530567ed2bd147a057bef500-text/javascript"></script>

<script src="{{asset('backend/assets/js/feather.min.js')}}" type="530567ed2bd147a057bef500-text/javascript"></script>

<!--<script src="{{asset('backend/assets/plugins/moment/moment.min.js')}}" type="e7d4f3ec066f369a18345d43-text/javascript"></script>--->

<script src="{{asset('backend/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}" type="530567ed2bd147a057bef500-text/javascript"></script>

<script src="{{asset('backend/assets/plugins/apexchart/apexcharts.min.js')}}" type="530567ed2bd147a057bef500-text/javascript"></script>

<script src="{{asset('backend/assets/plugins/apexchart/chart-data.js')}}" type="530567ed2bd147a057bef500-text/javascript"></script>

<!--<script src="{{asset('backend/assets/plugins/select2/js/select2.min.js')}}" type="e7d4f3ec066f369a18345d43-text/javascript"></script>--->

<script src="{{asset('backend/assets/js/script.js')}}" type="530567ed2bd147a057bef500-text/javascript"></script>

<script src="{{asset('backend/assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="530567ed2bd147a057bef500-|49" defer></script>

<!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->


<script src="{{asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	
	<!--app JS-->




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script>
   function confirmDelete(deleteUrl) {
      Swal.fire({
         title: 'Are you sure?',
         text: 'You won\'t be able to revert this!',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
         if (result.isConfirmed) {
            // If confirmed, redirect to the delete URL
            window.location.href = deleteUrl;
         }
      });
   }
</script>

<script>
		$(document).ready(function() {
			$('.datatable').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>




<!-- Bootstrap JS (if using Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Your Custom Script -->
<script>
    $(document).ready(function () {
        $('.datetimepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
</script>



</body>


</html>