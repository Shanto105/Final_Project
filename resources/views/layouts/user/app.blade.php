
@php
$setting=DB::table('setting')->where('id',1)->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure-html.dreamguystech.com/cosmetics/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Nov 2021 18:28:41 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, barber-scalable=0">
<title>HairStyle Apponment System</title>

<link type="image/x-icon" href="{{ asset('barber/')}}/assets/img/favicon.png" rel="icon">

<link rel="stylesheet" href="{{ asset('barber/')}}/assets/css/bootstrap.min.css">

<link rel="stylesheet" href="{{ asset('barber/')}}/assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="{{ asset('barber/')}}/assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="{{ asset('barber/')}}/assets/css/style.css">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>
<body>

<div class="main-wrapper">

<header class="header">
<nav class="navbar navbar-expand-lg header-nav">
<div class="navbar-header">
<a id="mobile_btn" href="javascript:void(0);">
<span class="bar-icon">
<span></span>
<span></span>
<span></span>
</span>
</a>
<a href="{{url('/')}}" class="navbar-brand logo">
<img src="{{ asset($setting->logo)}}" class="img-fluid" alt="Logo" style="height:60px; width:120px;">
</a>
</div>
<div class="main-menu-wrapper">
<div class="menu-header">
<a href="index-2.html" class="menu-logo">
<img src="{{ asset($setting->logo)}}" class="img-fluid" alt="Logo">
</a>
<a id="menu_close" class="menu-close" href="javascript:void(0);">
<i class="fas fa-times"></i>
</a>
</div>
<ul class="main-nav">
  
<li class="active">
<a href="/">Home</a>
</li>




@php  
  $category=DB::table('category')->get();
@endphp
<li class="has-submenu">
<a href="#">HairStyle <i class="fas fa-chevron-down"></i></a>
<ul class="submenu">
@foreach($category as $row)	
<li><a href="{{url('category/doctor/list/'.$row->id)}}">{{$row->title}}</a></li>
@endforeach
</ul>
</li>






<li>
<a href="{{ route('admin.login') }}" target="_blank">Admin</a>
</li>
<li>
<a href="{{ route('barber.login') }}" target="_blank">Salon Login</a>
</li>
<li class="login-link">
<a href="{{ route('user.login') }}">Login / Signup</a>
</li>

</ul>
</div>
@guest
<ul class="nav header-navbar-rht">
<li class="nav-item">
<a class="nav-link header-login" style="height: 40px; margin-top:5px;" href="{{ route('user.login') }}">login / Signup </a>
</li>
<li class="has-submenu">
<div class="search-box">
<form action="{{ route('doctor.search') }}"method="post">
  @csrf
<style>
  #searce-top{
    height: 40px !important;
    padding: 10px;
    box-sizing: border-box;
    margin-right: 10px;
    color:tomato;
    border:1px solid tomato;
  }
</style>
<div>
<input id="searce-top" type="text"  placeholder="Search Hairstyle" name="search" style="height: 20px; width: 300px; " required>
</div>
<button type="submit" class="btn btn-sm btn-primary " style="height: 40px; width: 100px; "><span>Search</span></button>
</form>
</div>

</div>
</li>
</ul>
@else

<ul class="nav header-navbar-rht">
<li>
<a href="{{ route('user.profile.show') }}" >Profile</a>
</li>
<li class="nav-item">
<a class="nav-link header-login" href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
 <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
</li>
<li class="has-submenu">
<div class="search-box">
<form action="{{ route('doctor.search') }}"method="post">
  @csrf
  <style>
  #searce-top{
    height: 40px !important;
    padding: 10px;
    box-sizing: border-box;
    margin-right: 10px;
    color:tomato;
    border:1px solid tomato;
  }
</style>
<div>
<input id="searce-top" type="text"  placeholder="Search Hairstyle" name="search" style="height: 20px; width: 300px; " required>
</div>
<button type="submit" class="btn btn-sm btn-primary " style="height: 40px; width: 100px; "><span>Search</span></button>
</form>
</div>

</div>
</li>

</ul>
@endguest
</nav>
</header>



@yield('content')



<section class="address-section">
<div class="container">
<div class="row">
<div class="col-12 col-md-6">
<address class="m-0 d-flex align-items-center">
<span class="d-flex align-items-center justify-content-center map-icon">
<i class="fas fa-map-marker-alt"></i>
</span>
<span>
{{$setting->address}}
</span>
</address>
</div>
<div class="col-12 col-md-6">
<div class="social-links">
<ul>
<li><a href="{{$setting->fb_link}}"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="{{$setting->twiter_link}}"><i class="fab fa-twitter"></i></a></li>
<li><a href="{{$setting->youtoube_link}}"><i class="fab fa-youtube"></i></a></li>
</ul>
</div>
</div>
</div>
</div>
</section>


<footer class="footer">

<div class="footer-top">
<div class="container-fluid">
<div class="row align-items-center">
<div class="col-lg-3 col-md-6">

<div class="footer-widget footer-about">
<div class="footer-logo">
<img src="{{ asset($setting->logo)}}" class="img-fluid" alt="Logo" style="height:60px; width:180px;">
</div>
<div class="footer-about-content">
<div class="social-icon">
<ul>
<li>
<a href="#" target="_blank"><img src="{{ asset('barber/')}}/assets/img/payment1.jpg" alt=""></a>
</li>
<li>
<a href="#" target="_blank"><img src="{{ asset('barber/')}}/assets/img/payment2.jpg" alt=""></a>
</li>
<li>
<a href="#" target="_blank"><img src="{{ asset('barber/')}}/assets/img/payment3.jpg" alt=""></a>
</li>
<li>
<a href="#" target="_blank"><img src="{{ asset('barber/')}}/assets/img/payment4.jpg" alt=""></a>
</li>
</ul>
</div>
</div>
</div>

</div>
<div class="col-lg-3 col-md-6">

<div class="footer-widget footer-menu">
<h2 class="footer-title">For HairStyle</h2>
<ul>
<li><a href="#">Search for HairStyle</a></li>
<li><a href="#">Login</a></li>
<li><a href="#">Register</a></li>
<li><a href="#">Booking</a></li>
<li><a href="#"> Dashboard</a></li>
</ul>
</div>

</div>
<div class="col-lg-3 col-md-6">

<div class="footer-widget footer-menu">
<h2 class="footer-title">For User</h2>
<ul>
<li><a href="#">Appointments</a></li>
<li><a href="#">Chat</a></li>
<li><a href="#">Login</a></li>
<li><a href="#">Register</a></li>
<li><a href="#"> Dashboard</a></li>
</ul>
</div>

</div>
<div class="col-lg-3 col-md-6">

<div class="footer-widget footer-menu">
<h2 class="footer-title">Sitemap</h2>
<ul>
<li><a href="#">Blog</a></li>
<li><a href="#">FAQs</a></li>
<li><a href="#">Payment</a></li>
<li><a href="#">Shipment</a></li>
<li><a href="#">Return policy</a></li>
</ul>
</div>

</div>
</div>
</div>
</div>


<div class="footer-bottom">
<div class="container-fluid">

<div class="copyright">
<div class="row">
<div class="col-md-6 col-lg-6">
<div class="copyright-text">
<p class="mb-0">&copy; 2023 Hashibul Hossain Shanto</p>
</div>
</div>
<div class="col-md-6 col-lg-6">

<div class="copyright-menu">
<ul class="policy-menu">
<li><a href="term-condition.html">Terms and Conditions</a></li>
<li><a href="privacy-policy.html">Policy</a></li>
</ul>
</div>

</div>
</div>
</div>

</div>
</div>

</footer>

</div>


<script src="{{ asset('barber/')}}/assets/js/jquery-3.6.0.min.js"></script>

<script src="{{ asset('barber/')}}/assets/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('barber/')}}/assets/js/slick.js"></script>

<script src="{{ asset('barber/')}}/assets/js/script.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
 
  @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}"

  
        switch(type){
              case 'info':
                 toastr.info("{{ Session::get('message') }}");
                 break;
          case 'success':
              toastr.success("{{ Session::get('message') }}");
              break;
        case 'warning':
              toastr.warning("{{ Session::get('message') }}");
              break;
          case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
  @endif
</script>
</body>

<!-- Mirrored from doccure-html.dreamguystech.com/cosmetics/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 14 Nov 2021 18:28:57 GMT -->
</html>