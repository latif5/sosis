<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Software Administrasi Hotspot Javanet">
		<meta name="author" content="Miftah Afina - www.miftahafina.com">
		<link rel="icon" href="assets/ico/favicon.ico">

		<title>SOSIS</title>

		<!-- CSS inti bootstrap -->
		<link href="{{ asset('assets/css/bootstrap.css') }}" type="text/css" rel="stylesheet"/>

		<!-- CSS ubahsuaian untuk template ini -->
		<link href="{{ asset('assets/css/signin.css') }}" type="text/css" rel="stylesheet"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body style="background-image: url('{{ asset('assets/img/'. rand(1, 11) .'.jpg') }}')">

		<div class="container">
			<div class="well col-md-4 col-md-offset-8">
				@yield('content')
			</div>
		</div> <!-- /container -->

		<!-- Inti JavaScript Bootstrap -->
		<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="{{ asset('assets/js/ie10-viewport-bug-workaround.js') }}"></script>

		<!-- JavaScript Ubahsuaian -->
		<script type="text/javascript">
		// Menambahkan efek fadein pada form login
		$(document).ready(function(){
			$(".well").hide(0).delay(200).fadeIn(700)
		});
		</script>
	</body>
</html>
