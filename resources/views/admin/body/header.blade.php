@php

$setting = App\Models\Settings::find(1);

@endphp
<div class="header">

<div class="header-left">
<a href="index.html" class="logo">
<img src="{{ asset($setting->logo) }}" alt="Logo">
</a>
<a href="index.html" class="logo logo-small">
<img src="{{ asset($setting->logo) }}" alt="Logo" width="30" height="30">
</a>
</div>

<div class="menu-toggle">
<a href="javascript:void(0);" id="toggle_btn">
<i class="fas fa-bars"></i>
</a>
</div>

<div class="top-nav-search">
<form>
<input type="text" class="form-control" placeholder="Search here">
<button class="btn" type="submit"><i class="fas fa-search"></i></button>
</form>
</div>


<a class="mobile_btn" id="mobile_btn">
<i class="fas fa-bars"></i>
</a>


<ul class="nav user-menu">
<li class="nav-item dropdown noti-dropdown language-drop me-2">
<a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
<img src="{{asset('backend/assets/img/icons/header-icon-01.svg')}}" alt>
</a>
<div class="dropdown-menu ">
<div class="noti-content">
<div>
<a class="dropdown-item" href="{{ url('en/') }}"><i class="flag flag-lr me-2"></i>English</a>
<a class="dropdown-item" href="{{ url('fr/') }}"><i class="flag flag-bl me-2"></i>Francais</a>
<a class="dropdown-item" href="{{ url('es/') }}"><i class="flag flag-cn me-2"></i>Spanish</a>
</div>
</div>
</div>
</li>

<li class="nav-item dropdown noti-dropdown me-2">
<a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
<img src="{{asset('backend/assets/img/icons/header-icon-05.svg')}}" alt>
</a>
<div class="dropdown-menu notifications">
<div class="topnav-dropdown-header">
<span class="notification-title">Notifications</span>
<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
</div>
<div class="noti-content">
<ul class="notification-list">
<li class="notification-message">
<a href="#">
<div class="media d-flex">
<span class="avatar avatar-sm flex-shrink-0">
<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-02.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">Carlson Tech</span> has approved <span class="noti-title">your estimate</span></p>
<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<a href="#">
<div class="media d-flex">
<span class="avatar avatar-sm flex-shrink-0">
<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-11.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">International Software Inc</span> has sent you a invoice in the amount of <span class="noti-title">$218</span></p>
<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<a href="#">
<div class="media d-flex">
<span class="avatar avatar-sm flex-shrink-0">
<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-17.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">John Hendry</span> sent a cancellation request <span class="noti-title">Apple iPhone XR</span></p>
<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
</div>
</div>
</a>
</li>
<li class="notification-message">
<a href="#">
<div class="media d-flex">
<span class="avatar avatar-sm flex-shrink-0">
<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-13.jpg">
</span>
<div class="media-body flex-grow-1">
<p class="noti-details"><span class="noti-title">Mercury Software Inc</span> added a new product <span class="noti-title">Apple MacBook Pro</span></p>
<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
</div>
</div>
</a>
</li>
</ul>
</div>
<div class="topnav-dropdown-footer">
<a href="#">View all Notifications</a>
</div>
</div>
</li>

<li class="nav-item zoom-screen me-2">
<a href="#" class="nav-link header-nav-list win-maximize">
<img src="{{asset('backend/assets/img/icons/header-icon-04.svg')}}" alt>
</a>
</li>

@php
$id = Auth::user()->id;
$adminData = App\Models\User::find($id);
@endphp

<li class="nav-item dropdown has-arrow new-user-menus">
<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
<div class="user-img">
<img class="rounded-circle" src="{{ (!empty($adminData->photo)) ? url('upload/admin_images/'.$adminData->photo):url('upload/no_image.jpg') }}" width="31" alt="Ryan Taylor">
<div class="user-text">
<h6>{{Auth::user()->name}}</h6>
<p class="text-muted mb-0">Administrator</p>
</div>
</div>
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="{{ route('admin.profile') }}">My Profile</a>
<a class="dropdown-item" href="inbox.html">Inbox</a>
<a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
</div>
</li>

</ul>

</div>


<script>
$(document).ready(function () {
    $("#toggle_btn").on("click", function () {
        $(".sidebar").toggleClass("active");
    });
});
</script>