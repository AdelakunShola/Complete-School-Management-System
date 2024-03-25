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


<style>

body{
    margin-top:20px;
}
.bg-light-gray {
    background-color: #f7f7f7;
}
.table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 2px;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}


.bg-sky.box-shadow {
    box-shadow: 0px 5px 0px 0px #00a2a7
}

.bg-orange.box-shadow {
    box-shadow: 0px 5px 0px 0px #af4305
}

.bg-green.box-shadow {
    box-shadow: 0px 5px 0px 0px #4ca520
}

.bg-yellow.box-shadow {
    box-shadow: 0px 5px 0px 0px #dcbf02
}

.bg-pink.box-shadow {
    box-shadow: 0px 5px 0px 0px #e82d8b
}

.bg-purple.box-shadow {
    box-shadow: 0px 5px 0px 0px #8343e8
}

.bg-lightred.box-shadow {
    box-shadow: 0px 5px 0px 0px #d84213
}


.bg-sky {
    background-color: #02c2c7
}

.bg-orange {
    background-color: #e95601
}

.bg-green {
    background-color: #5bbd2a
}

.bg-yellow {
    background-color: #f0d001
}

.bg-pink {
    background-color: #ff48a4
}

.bg-purple {
    background-color: #9d60ff
}

.bg-lightred {
    background-color: #ff5722
}

.padding-15px-lr {
    padding-left: 15px;
    padding-right: 15px;
}
.padding-5px-tb {
    padding-top: 5px;
    padding-bottom: 5px;
}
.margin-10px-bottom {
    margin-bottom: 10px;
}
.border-radius-5 {
    border-radius: 5px;
}

.margin-10px-top {
    margin-top: 10px;
}
.font-size14 {
    font-size: 14px;
}

.text-light-gray {
    color: #d6d5d5;
}
.font-size13 {
    font-size: 13px;
}

.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}


/* Dropdown button container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown menu */
.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 120px;
    z-index: 1;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

/* Show dropdown menu on hover */
.dropdown:hover .dropdown-menu {
    display: block;
}

/* Style list items */
.dropdown-menu li {
    list-style-type: none;
}

/* Style anchor tags */
.dropdown-menu li a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
}

/* Change anchor tag color on hover */
.dropdown-menu li a:hover {
    background-color: #f5f5f5;
}

/* Arrow */
.dropdown-menu:before {
    content: '';
    position: absolute;
    top: -10px;
    left: 50%;
    margin-left: -5px;
    border-width: 0 5px 5px;
    border-style: solid;
    border-color: transparent transparent #fff;
}





    </style>

@php
        // Get the class name
        $className = $section->class->class_name;

        // Fetch timetable for the current section
        $sectionTimetable = $timetable->where('section_id', $section->id);

        $setting = App\Models\Settings::find(1);
    @endphp


<div class="page-header">
<div class="row align-items-center">
<div class="btn btn-outline-primary me-2 ">
<h3 class="">{{ $setting -> website_name }}</h3>
<h3 class="page-title">View Timetable / Class Routine For {{ ($className) }} {{ $section->name }}</h3>
<h5 class="page-title">{{ $setting -> website_name }}</h5>
</div>
<!-- Add the print button here -->
<button style="width: 10%;" class="btn btn-primary" onclick="printPage()">Print</button> / <a style="width: 10%;" href="#" data-bs-toggle="modal" data-bs-target="#con-close-modal1" class="btn btn-primary me-2" onclick="printPage()">Download </a>
</div>
</div>

<div class="section-container">
<!-- Display section name -->
<div style="width: 100%;" class="btn btn-outline-primary me-2">
<h2><span class="btn btn-outline-primary ">{{ $className }}</span></h2>
<div class="text-uppercase col-auto  ms-auto download-grp">
<h4 href="#" class="btn btn-outline-primary me-2">
{{ $section->name }}</h4>

</div>


<!-- Fetch timetable for the current section -->
@php
$sectionTimetable = $timetable->where('section_id', $section->id);
@endphp

<!-- Render timetable for the current section -->
<div class="timetable-img text-center">
<img src="img/content/timetable.png" alt="">
</div>


@if($sectionTimetable->isNotEmpty())
<strong class="text-uppercase"> Class: </strong>
{{ $className }}

<strong class="text-uppercase"> Section: </strong>
{{ $section->name }}
@endif

</div>


<div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
<tr class="bg-light-gray">
<th class="text-uppercase">Time</th>
<th class="text-uppercase">Monday</th>
<th class="text-uppercase">Tuesday</th>
<th class="text-uppercase">Wednesday</th>
<th class="text-uppercase">Thursday</th>
<th class="text-uppercase">Friday</th>
<th class="text-uppercase">Saturday</th>
</tr>
</thead>

<tbody>
@php
// Manually define time slots with the desired format
$time_slots = [
'08:00 AM - 08:40 AM', '08:41 AM - 09:20 AM', '09:21 AM - 10:00 AM',
'10:01 AM - 10:40 AM', '10:41 AM - 11:20 AM', '11:21 AM - 12:00 PM',
'12:01 PM - 12:40 PM', '12:41 PM - 01:20 PM', '01:21 PM - 02:00 PM',
'02:01 PM - 02:40 PM', '02:41 PM - 03:20 PM', '03:21 PM - 04:00 PM',
'04:01 PM - 04:40 PM', '04:41 PM - 05:20 PM'
];

// Loop through each time slot
foreach ($time_slots as $current_time) {
echo '<tr>';
echo '<td class="align-middle">' . $current_time . '</td>'; // Display time range

// Loop through each day of the week
foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $weekday) {
echo '<td>';
// Loop through items for the current day
foreach ($sectionTimetable->groupBy('day') as $day => $itemsByDay) {
if ($day == $weekday) {
// Check if there's an item for the current time slot and day
foreach ($itemsByDay as $item) {
$start = strtotime($item->time_start . ':' . $item->time_start_min . ($item->start_day_period == 1 ? 'AM' : 'PM'));
$end = strtotime($item->time_end . ':' . $item->time_end_min . ($item->end_day_period == 1 ? 'AM' : 'PM'));
if ($start <= strtotime(explode(' - ', $current_time)[0]) && $end >= strtotime(explode(' - ', $current_time)[1])) {
// Dropdown button with CSS only
echo '<div class="dropdown">';
echo '<span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-black font-size16 xs-font-size13">' . $item->subject->name . '</span><i class="fa fa-angle-down menu-arrow"></i>';
echo '<ul class="dropdown-menu">';
echo '<li><a href="' . route('edit.timetable', $item->id) . '">Edit</a></li>'; // Dynamic edit link
echo '<li><a href="#">Delete</a></li>';
echo '</ul>';
echo '</div>';
// End of dropdown button
echo '<div class="margin-10px-top font-size14">' . $item->time_start . ':' . $item->time_start_min . ($item->start_day_period == 1 ? 'AM' : 'PM') . ' - ' . $item->time_end . ':' . $item->time_end_min . ($item->end_day_period == 1 ? 'AM' : 'PM') . '</div>';
echo '<div class="font-size13 text-light-gray">' . $item->subject->teacher->name . '</div>';
}
}
}
}
echo '</td>';
}
echo '</tr>';
}
@endphp
</tbody>
</table>
</div>

</div>


<script>
function printPage() {
    window.print(); // Trigger the browser's print functionality
}
</script>

</body>


</html>
