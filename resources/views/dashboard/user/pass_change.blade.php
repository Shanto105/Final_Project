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
<h2 class="breadcrumb-title">Change Password</h2>
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
<img src="{{asset($user->image)}}" >    
</a>
<div class="profile-det-info">
<h3>{{ Auth::guard('web')->user()->name }}</h3>
<div class="patient-details">
<h5 class="mb-0">{{ Auth::guard('web')->user()->email }}</h5>
<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Newyork, USA</h5>
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

<li>
<a href="{{route('user.profile.update')}}">
<i class="fas fa-user-cog"></i>
<span>Update Profile</span>
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
<div class="row">
<div class="col-md-12 col-lg-6">

<form class="add-contact-form" method="post" action="{{ route('user-passchange')}}"enctype="multipart/form-data">    
  @csrf
<div class="form-group">
<label>Old Password</label>
<input type="password" name="oldpassword" class="form-control">
</div>
<div class="form-group">
<label>New Password</label>
<input type="password" name="newpassword" class="form-control">
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
</div>
</div>
@endsection