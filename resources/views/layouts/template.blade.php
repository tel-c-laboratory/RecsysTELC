<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>TEL-C Recruitment System</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ asset('css/paper-dashboard.css') }}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">

</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

  	<div class="sidebar-wrapper">
      <div class="logo">
          <a href="#" class="simple-text">
              RECSYS
          </a>
      </div>

      <ul class="nav">
        <li class="{{ Request::is('home') ? "active" : ""}}">
            <a href="{{ route('home') }}">
                <i class="ti-panel"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ Request::is('profile') ? "active" : ""}}">
            <a href="{{ route('profile') }}">
                <i class="ti-user"></i>
                <p>User Profile</p>
            </a>
        </li>
				<li class="{{ Request::is('attachment') ? "active" : ""}}">
            <a href="{{ route('seleksi.index') }}">
                <i class="ti-file"></i>
                <p>Attachment</p>
            </a>
        </li>
      </ul>
  	</div>
  </div>

  <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Technology Enhanced Learning Center</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
						            <li>
                          <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
								          <i class="ti-unlock"></i>
								          <p>Logout</p>
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        @yield('content')


        <footer class="footer">
            <div class="container-fluid">
                <!-- <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                    </ul>
                </nav> -->
				<div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="#">TEL-C Research Laboratory</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

  <!--   Core JS Files   -->
  <script src="{{ asset('js/jquery-1.10.2.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="{{ asset('js/bootstrap-checkbox-radio.js') }}"></script>

	<!--  Charts Plugin -->
	<script src="{{ asset('js/chartist.min.js') }}"></script>

  <!--  Notifications Plugin    -->
  <script src="{{ asset('js/bootstrap-notify.js') }}"></script>

  <!--  Google Maps Plugin    -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

  <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="{{ asset('js/paper-dashboard.js') }}"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="{{ asset('js/demo.js') }}"></script>

</html>
