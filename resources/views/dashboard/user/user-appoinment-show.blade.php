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
<h2 class="breadcrumb-title">Dashboard</h2>
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
</div>
</div>
</div>
</div>
<div class="dashboard-widget">
<nav class="dashboard-menu">
<ul>
<li class="active">
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
<div class="card-body pt-0">

<nav class="user-tabs mb-4">
<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
<li class="nav-item">
<a class="nav-link active" href="#pat_appointments" data-bs-toggle="tab">Appointments</a>
</li>


</ul>
</nav>


<div class="tab-content pt-0">

<div id="pat_appointments" class="tab-pane fade show active">
<div class="card card-table mb-0">
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0">
<thead>
<tr>
<th>Serial Number</th>
<th>Salon </th>
<th>Amount</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>
<th></th>
</tr>
</thead>
<tbody>
    @foreach($profile as $row)
<tr>
<td>
{{$row->id}}
</td>
<td>
<h2 class="table-avatar">
<a href="doctor-profile.html" class="avatar avatar-sm me-2">
<img class="avatar-img rounded-circle" src="{{ asset($row->image)}}" alt="User Image">
</a>
<a href="doctor-profile.html">{{$row->name}} <span>{{$row->specialization}}</span></a>
</h2>
</td>
<td>{{$row->price}} TK</td>
<td>{{$row->appoinment_date}} </td>
<td>{{$row->appoinment_time}} </td>
 @if($row->status == 0)
 <td><span class="badge rounded-pill bg-warning-light">Pending</span></td>
@elseif($row->status == 1)
<td><span class="badge rounded-pill bg-success-light">Confirm</span></td>
@elseif($row->status == 2)
<td><span class="badge rounded-pill bg-success-light">Finaly Done Appoinment</span></td>
@else
<td><span class="badge rounded-pill bg-danger-light">Cancelled</span></td>
@endif

<td>

<a href="{{ url('delete/appoinment/user/'.$row->id) }}" class="product-table-danger" data-toggle="tooltip" title="Delete Appoinment"><i class="fa fa-trash"></i></a>
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
</div>
</div>
</div>
</div>
</div>
@endsection

