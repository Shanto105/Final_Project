@extends('layouts.user.app')

@section('content')

<div class="breadcrumb-bar">
<div class="container-fluid">
<div class="row align-items-center">
<div class="col-md-12 col-12">
<nav aria-label="breadcrumb" class="page-breadcrumb">
<ol class="breadcrumb">

</ol>
</nav>
<h2 class="breadcrumb-title">Profile Settings</h2>
</div>
</div>
</div>
</div>


<div class="content">
<div class="container-fluid">
<div class="row">

<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
<div class="profile-sidebar">
<div class="widget-profile pro-widget-content">
<div class="profile-info-widget">
<a href="#" class="booking-doc-img">
<img src="{{asset($user->image)}}" alt="User Image">
</a>
<div class="profile-det-info">
<h3>{{$user->name}}</h3>
<div class="patient-details">
<h5><i class="fas fa-birthday-cake"></i> {{$user->date_of_brith}}</h5>
<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{$user->user_address}}</h5>
</div>
</div>
</div>
</div>
<div class="dashboard-widget">
<nav class="dashboard-menu">
<ul>
<li>
<a href="{{route('user.profile.show')}}">
<i class="fas fa-columns"></i>
<span>Dashboard</span>
</a>
</li>


<li class="active">
<a href="profile-settings.html">
<i class="fas fa-user-cog"></i>
<span>Profile Settings</span>
</a>
</li>
<li>
<a href="{{route('user.pass.change')}}">
<i class="fas fa-lock"></i>
<span>Change Password</span>
</a>
</li>
<li>
<a class="nav-link header-login" href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
 <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
</li>
</ul>
</nav>
</div>
</div>
</div>

<div class="col-md-7 col-lg-8 col-xl-9">
<div class="card">
<div class="card-body">

<form class="add-contact-form" method="post" action="{{ route('user-profile-update-account')}}"enctype="multipart/form-data">    
    @csrf
<div class="row form-row">
<div class="col-12 col-md-12">
<div class="form-group">
<div class="change-avatar">
<div class="profile-img">
<img src="{{asset($user->image)}}" alt="User Image">
</div>
<div class="upload-img">
<div class="change-photo-btn">
<span><i class="fa fa-upload"></i> Upload Photo</span>
<input type="file" class="upload" name="image">
</div>
<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
</div>
</div>
</div>
</div>
<div class="col-12 col-md-12">
<div class="form-group">
<label>First Name</label>
<input type="text" class="form-control" name="name" value="{{$user->name}}">
</div>
</div>


<div class="col-12 col-md-6">
<div class="form-group">
<label>Date of Birth</label>
<div class="cal-icon">
<input type="date" class="form-control datetimepicker" name="date_of_brith" value="{{$user->date_of_brith}}">
</div>
</div>
</div>

<div class="col-12 col-md-6">
<div class="form-group">
<label>Email ID</label>
<input type="email" class="form-control" name="email" value="{{$user->email}}">
</div>
</div>
<div class="col-12 col-md-12">
<div class="form-group">
<label>Mobile</label>
<input type="text"  name="Mobile" value="{{$user->Mobile}}" class="form-control">
</div>
</div>
<div class="col-12">
<div class="form-group">
<label>Address</label>
<input type="text" class="form-control" name="user_address" value="{{$user->user_address}}">
</div>
</div>
<div class="col-12 col-md-6">
<div class="form-group">
<label>City</label>
<input type="text" class="form-control" name="city" value="{{$user->city}}">
</div>
</div>
<div class="col-12 col-md-6">
<div class="form-group">
<label>State</label>
<input type="text" class="form-control" name="state" value="{{$user->state}}">
</div>
</div>


</div>
<div class="submit-section">
<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
</div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>

@endsection

