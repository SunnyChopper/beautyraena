<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">

		@if(isset($title))
		<title>{{ $title }}</title>
		@else
		<title>{{ config('app.name') }}</title>
		@endif

		<meta content="" name="description">
		<meta content="" name="keywords">

		<!-- Favicons -->
		<link href="{{ URL::asset('img/favicon.png') }}" rel="icon">
		<link href="{{ URL::asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

		<!-- Vendor CSS Files -->
		<link href="{{ URL::asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

		<!-- Template Main CSS File -->
		<link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('css/layouts.css') }}" rel="stylesheet">
	</head>
	<body>
		<div id="app">
			@include('layouts.navbar')
			@yield('content')
			@include('layouts.footer')
			@include('layouts.js')
		</div>
	</body>
</html>