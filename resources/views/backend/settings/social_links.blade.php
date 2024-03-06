@extends('admin.admin_dashboard')
@section('admin')

<div class="content container-fluid">
<div class="page-header">
<div class="row">
<div class="col">
<h3 class="page-title">Settings</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="settings.html">Settings</a></li>
<li class="breadcrumb-item active">Social Links</li>
</ul>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">

<div class="settings-menu-links">
<ul class="nav nav-tabs menu-tabs">
<li class="nav-item  ">
<a class="nav-link" href="{{ route('settings') }}">General Settings</a>
</li>
<li class="nav-item">
<a class="nav-link" href="localization-details.html">Localization</a>
</li>
<li class="nav-item">
<a class="nav-link" href="payment-settings.html">Payment Settings</a>
</li>
<li class="nav-item">
<a class="nav-link" href="email-settings.html">Email Settings</a>
</li>
<li class="nav-item active">
<a class="nav-link" href="social-settings.html">Social Media Login</a>
</li>
<li class="nav-item ">
<a class="nav-link" href="{{ route('social.links') }}">Social Links</a>
</li>
<li class="nav-item">
<a class="nav-link" href="seo-settings.html">SEO Settings</a>
</li>
<li class="nav-item">
<a class="nav-link" href="others-settings.html">Others</a>
</li>
</ul>
</div>

<div class="row">
<div class="col-lg-6 col-md-8">
<div class="card">
<div class="card-header">
<h5 class="card-title">Social Link Settings</h5>
</div>
<div class="card-body pt-0">

<form action="{{ route('update.social.links') }}" method="POST">
@csrf
<input type="hidden" name="id" value="{{ $social_links->id }}">

<div class="settings-form">

<div class="links-info">
<div class="row form-row links-cont">
<div class="form-group form-placeholder d-flex">
<button class="btn social-icon">
<i class="feather-facebook"></i>
</button>
<input type="text" class="form-control" name="facebook" value="{{ $social_links->facebook }}">
</div>
</div>
</div>

<div class="links-info">
<div class="row form-row links-cont">
<div class="form-group form-placeholder d-flex">
<button class="btn social-icon">
<i class="feather-twitter"></i>
</button>
<input type="text" class="form-control" name="twitter" value="{{ $social_links->twitter }}">
</div>
</div>
</div>


<div class="links-info">
<div class="row form-row links-cont">
<div class="form-group form-placeholder d-flex">
<button class="btn social-icon">
<i class="feather-instagram"></i>
</button>
<input type="text" class="form-control" name="instagram" value="{{ $social_links->instagram }}">
</div>
</div>
</div>

</div>

<div class="form-group mb-0">
<div class="settings-btns">
<button type="submit" class="btn btn-orange">Submit</button>

</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection