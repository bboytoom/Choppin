<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'My Laravel Store')</title>
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

	@if(\Session::has('message'))
		@include('store.partials.message')
	@endif
	
	@include('store.partials.nav')

	@yield('content')

	@include('store.partials.footer')

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>