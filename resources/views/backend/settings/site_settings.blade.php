@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content container-fluid">
<div class="page-header">
<div class="row">
<div class="col">
<h3 class="page-title">Settings</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="settings.html">Settings</a></li>
<li class="breadcrumb-item active">General Settings</li>
</ul>
</div>
</div>
</div>

<div class="settings-menu-links">
<ul class="nav nav-tabs menu-tabs">
<li class="nav-item active">
<a class="nav-link" href="settings.html">General Settings</a>
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
<li class="nav-item">
<a class="nav-link" href="social-settings.html">Social Media Login</a>
</li>
<li class="nav-item">
<a class="nav-link" href="social-links.html">Social Links</a>
</li>
<li class="nav-item">
<a class="nav-link" href="seo-settings.html">SEO Settings</a>
</li>
<li class="nav-item">
<a class="nav-link" href="others-settings.html">Others</a>
</li>
</ul>
</div>

<form action="{{  route('update.site_settings') }}" method="post" enctype="multipart/form-data">
@csrf

<input type="hidden" name="id" value="{{ $site->id }}">

<div class="row">
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h5 class="card-title">Website Basic Details</h5>
</div>
<div class="card-body pt-0">




<div class="settings-form">
<div class="form-group">
<label>Website Name <span class="star-red">*</span></label>
<input type="text" class="form-control" name="website_name" value="{{ $site->website_name }}">
</div>

<div class="form-group">
<p class="settings-label">Logo <span class="star-red">*</span></p>
<div class="settings-btn">
<input type="file" name="logo" lass="hide-input" >
<label for="file" class="upload">
<i class="feather-upload"></i>
</label>
</div>
<h6 class="settings-size">Recommended image size is <span>150px x 150px</span></h6>
<div class="upload-images">
<img src="{{ asset($site->logo) }}" alt="logo">
<a href="javascript:void(0);" class="btn-icon logo-hide-btn">
<i class="feather-x-circle"></i>
</a>
</div>
</div>

<div class="form-group">
<p class="settings-label">Favicon <span class="star-red">*</span></p>
<div class="settings-btn">
<input type="file" accept="image/*" name="favicon" id="file" onchange="if (!window.__cfRLUnblockHandlers) return false; loadFile(event)" class="hide-input" data-cf-modified-bcc67d850c59774de6d823de->
<label for="file" class="upload">
<i class="feather-upload"></i>
</label>
</div>
<h6 class="settings-size">
Recommended image size is <span>16px x 16px or 32px x 32px</span>
</h6>
<h6 class="settings-size mt-1">Accepted formats: only png and ico</h6>
<div class="upload-images upload-size">
<img src="{{ asset($site->favicon) }}" alt="favicon">
<a href="javascript:void(0);" class="btn-icon logo-hide-btn">
<i class="feather-x-circle"></i>
</a>
</div>
</div>



</div>

</div>
</div>
</div>
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h5 class="card-title">Address Details</h5>
</div>
<div class="card-body pt-0">

<div class="settings-form">
<div class="form-group">
<label>Address Line 1 <span class="star-red">*</span></label>
<input type="text" class="form-control" placeholder="address" value="{{ $site->address }}">
</div>

<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>City <span class="star-red">*</span></label>
<input type="text" class="form-control" name="city" value="{{ $site->city }}">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>State/Province <span class="star-red">*</span></label>
<input type="text" class="form-control" name="state" value="{{ $site->state }}">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Zip/Postal Code <span class="star-red">*</span></label>
<input type="text" class="form-control" name="postal_code" value="{{ $site->postal_code }}">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Country <span class="star-red">*</span></label>
<input type="text" class="form-control" name="country" value="{{ $site->country }}">
</div>
</div>

</div>

<div class="form-group mb-0">
<div class="settings-btns">
<button type="submit" class="btn btn-orange">Update</button>
<button type="submit" class="btn btn-grey">Cancel</button>
</div>
</div>

</div>
</div>
</div>
</div>
</div>

</form>

</div>



@endsection