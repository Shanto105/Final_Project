@extends('layouts.user.app')

@section('content')
<div class="col-md-12 col-lg-12 col-xl-12">

@foreach($doctor as $row)
<div class="card">
<div class="card-body">
<div class="doctor-widget">
<div class="doc-info-left">
<div class="doctor-img">
<a href="doctor-profile.html">
<img src="{{ asset($row->image)}}" class="img-fluid" alt="User Image">
</a>
</div>
<div class="doc-info-cont">
<h4 class="doc-name"><a href="doctor-profile.html">{{$row->name}}</a></h4>
<p class="doc-speciality">{{$row->specialization}}</p>

<p class="doc-location"> SPECIALIZATION  - <a href="javascript:void(0);">{{$row->specialization}}</a></p>

<div class="clinic-details">
<p class="doc-location"> Exparience - <a href="javascript:void(0);">{{$row->experience}}</a></p>

</div>

<div class="clinic-services">

</div>
</div>
</div>
<div class="doc-info-right">
<div class="clini-infos">
<ul>

<li><i class="far fa-thumbs-up"></i> More Like</li>
<li><i class="far fa-comment"></i>More Feedback</li>
<li><i class="far fa-money-bill-alt"></i> {{$row->price}} Tk </li>
</ul>
</div>

<div class="clinic-booking">
<a class="view-pro-btn" href="{{ url('view/profile/'.$row->id) }}">View Profile</a>
<a class="apt-btn" href="{{ url('appoinment/'.$row->id) }}">Book Appointment</a>
</div>
</div>
</div>
</div>
</div>
@endforeach

<div class="load-more text-center">
<a class="btn btn-primary btn-sm" href="javascript:void(0);">Load More</a>
</div>
</div>
</div>
</div>
</div>

@endsection