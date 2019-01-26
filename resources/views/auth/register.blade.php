<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/paper_img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>TEL-C Recruitment System</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="{{ asset('bootstrap3/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/ct-paper.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/examples.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" type="image/png" href="{{{ asset('img/faviconlab.png') }}}" sizes="32x32" />

</head>
<body>
    <nav class="navbar navbar-ct-transparent navbar-fixed-top" role="navigation-demo" id="register-navbar">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TEL-C Recruitment System</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigation-example-2">
        <ul class="nav navbar-nav navbar-right">
			<li>
                <a href="https://www.instagram.com/telclab/" target="_blank" class="btn btn-simple"><i class="fa fa-instagram"></i></a>
            </li>
			<li>
                <a href="https://www.youtube.com/channel/UCG3bAlStTXDebo3YutwiyFQ" target="_blank" class="btn btn-simple"><i class="fa fa-youtube"></i></a>
            </li>
			<li>
                <a href="https://twitter.com/telclab" target="_blank" class="btn btn-simple"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
                <a href="https://www.facebook.com/telctelu" target="_blank" class="btn btn-simple"><i class="fa fa-facebook"></i></a>
            </li>
           </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-->
    </nav>

    <div class="wrapper">
        <div class="register-background">
            <div class="filter-black"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 ">
                            <div class="register-card">
                                <h3 class="title">Welcome</h3>
                                <form class="register-form" method="POST" action="{{ route('register') }}">
																	{{ csrf_field() }}
																		<label>NIM</label>
																		<input type="number" class="form-control" name="nim" maxlength="10" placeholder="NIM" value="{{ old('nim') }}" required autofocus>
																		@if ($errors->has('nim'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('nim') }}</strong>
		                                    </span>
		                                @endif

																		<label>Username</label>
																		<input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required>
																		@if ($errors->has('username'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('username') }}</strong>
		                                    </span>
		                                @endif

                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
																		@if ($errors->has('password'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif

																		<label>Password Confirmation</label>
																		<input type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" required>
																		@if ($errors->has('password_confirmation'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
		                                    </span>
		                                @endif

                                    <button type="submit" class="btn btn-danger btn-block">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="footer register-footer text-center">
                    <h6>&copy; 2017, made with <i class="fa fa-heart heart"></i> by TEL-C Reaserach Laboratory</h6>
            </div>
        </div>
    </div>

</body>

<script src="{{ asset('js/jquery-1.10.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-ui-1.10.4.custom.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('bootstrap3/js/bootstrap.js') }}" type="text/javascript"></script>

<!--  Plugins -->
<script src="{{ asset('js/ct-paper-checkbox.js') }}"></script>
<script src="{{ asset('js/ct-paper-radio.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('js/ct-paper.js') }}"></script>

</html>
