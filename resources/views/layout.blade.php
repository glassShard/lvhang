<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!-- my css -->

	<link rel="stylesheet" href="{{ mix('css/app.css') }}?version=2">
{{-- 	<link rel="preload" as="font" href="{{ mix('fonts/fontello.woff') }}">
	<link rel="preload" as="font" href="{{ mix('fonts/Gothic-Bold.woff') }}">
	<link rel="preload" as="font" href="{{ mix('fonts/Gothic-Regular.woff') }}"> --}}

	<link rel="apple-touch-icon" sizes="180x180" href="{{ Request::root() }}/favi/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ Request::root() }}/favi/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ Request::root() }}/favi/favicon-16x16.png">
	<link rel="manifest" href="{{ Request::root() }}/favi/site.webmanifest">
	<link rel="mask-icon" href="{{ Request::root() }}/favi/safari-pinned-tab.svg" color="#223135">
	<link rel="shortcut icon" href="{{ Request::root() }}/favi/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="LV Hang">
	<meta name="application-name" content="LV Hang">
	<meta name="msapplication-TileColor" content="#464645">
	<meta name="msapplication-config" content="./favi/browserconfig.xml">
	<meta name="theme-color" content="#343434">

	@yield('head')
	
</head>


<body class="body">
	@yield('content')

	@include('includes.footer')

	@include('includes.adminButton')

	@include('includes.cookies')

	@include('includes._modal')

	<button class="topScroller"><i class="fontello-up-dir"></i></button>

	<script src="{{ mix('js/app.js') }}?version=2"></script>
</body>

</html>