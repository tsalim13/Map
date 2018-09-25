<!DOCTYPE html>
<head>
<title>S-Mapper</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Boite de communication, Mapper, Gestion" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="shortcut icon" type="image/x-icon" href="icone.ico"/>
<link rel="icon" type="image/x-icon" href="icone.ico"/>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{URL::to('/')}}/css/bootstrap.css">
<!-- Custom CSS -->
<link href="{{URL::to('/')}}/css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{URL::to('/')}}/css/font.css" type="text/css"/>
<link href="{{URL::to('/')}}/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{URL::to('/')}}/js/jquery-3.3.1.js"></script>
<script src="{{URL::to('/')}}/js/modernizr.js"></script>
<script src="{{URL::to('/')}}/js/jquery.cookie.js"></script>
<script src="{{URL::to('/')}}/js/screenfull.js"></script>
	  <script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);
			if (!screenfull.enabled) {
				return false;
			}
			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});	
		});
	  </script>
	  @yield('scriptMap')
</head>
<body class="dashboard-page">
	<nav class="main-menu">
		<ul>
			<li>
				<div class="full-screen">
					<section class="full-top">
						<button id="toggle"><i class="fa fa-arrows-alt" aria-hidden="true"></i></button>	
					</section>
				</div> <br>
			</li>
			<li>
				<a href="{!! url('/accueil'); !!}">
					<i class="fa fa-home nav_icon"></i>
					<span class="nav-text">
						Accueil
					</span>
				</a>
			</li>
			<li>
				<a href="{!! url('client-edit'); !!}">
					<i class="fa fa-users nav-icon"></i>
					<span class="nav-text">
						Clients
					</span>
				</a>
			</li>
			<li>
				<a href="{!! url('map-client'); !!}">
					<i class="fa fa-map-marker nav_icon"></i>
					<span class="nav-text">
						Louer un emplacement
					</span>
				</a>
			</li>
			<li>
				<a href="{!!url('locations');!!}">
					<i class="icon-table nav-icon"></i>
					<span class="nav-text">
						Liste des locations
					</span>
				</a>
			</li>
			<li class="has-subnav">
				<a href="javascript:;">
				<i class="fa fa-cogs" aria-hidden="true"></i>
				<span class="nav-text">
					Opérations sur les emplacements
				</span>
				<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li>
					<a class="subnav-text" href="{!! url('edit'); !!}">
						&rArr; Carte
					</a>
					</li>
					<li>
					<a class="subnav-text" href="{!! url('MarkerList'); !!}">
						&rArr; Liste
					</a>
					</li>
					<li>
					<a class="subnav-text" href="{!! url('types'); !!}">
						&rArr; Parametre
					</a>
					</li>
				</ul>
			</li>
			@if(Auth::user()->role == 'admin')
			<li>
				<a href="{!! url('user-edit'); !!}">
					<i class="fa fa-navicon nav-icon"></i>
					<span class="nav-text">
					Employers
					</span>
				</a>
			</li>
			@endif
			<li>
				<a href="{!!url('locationsHist');!!}">
					<i class="icon-table nav-icon"></i>
					<span class="nav-text">
						Historique
					</span>
				</a>
			</li>
		</ul>
		<ul class="logout">
			<li>
				<a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="icon-off nav-icon"></i>
					<span class="nav-text">
					{{ __('Deconnexion') }}
					</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                </form>
			</li>
		</ul>
	</nav>
	<section class="wrapper scrollable">
		<nav class="user-menu">
			<a href="javascript:;" class="main-menu-access">
			<i class="icon-proton-logo"></i>
			<i class="icon-reorder"></i>
			</a>
		</nav>
		<section class="title-bar1">
			<div class="logo">
				<div class="col-md-5"><b>@yield('titrePage')</b></div>
				<div class="col-md-5 ind">@yield('indices')</div>
				<div class="col-md-2"><p style="padding: 0px">{{Auth::user()->name}}</p></div>
			</div>
			<div class="clearfix"> </div>
		</section>
@yield('content')
@yield('modalAdd')		
@yield('modalSupp')
		<!-- footer -->
		<div class="footer">
			<img src="{{URL::to('/')}}/images/logo.png">
			<p>© 2018 S-Mapper . All Rights Reserved .</p>
			<p>Email : gotlm13@gmail.com . Mobile : 0698 68 35 59</p>
			<div class="clearfix"></div>
		</div>
		<!-- //footer -->
	</section>
	<script src="{{URL::to('/')}}/js/bootstrap.js"></script>
	<script src="{{URL::to('/')}}/js/proton.js"></script>
@yield('scriptAjax')
</body>
</html>