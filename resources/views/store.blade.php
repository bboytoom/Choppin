<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=8; IE=9; IE=edge">
        <meta name="viewport" content="width=device-width,user-scalable=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tienda</title>

        <meta name="description:" content="">
		<meta name="author" content="SoyToom!!">
		<meta name="keywords" content="">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Page Wrapper -->
        <noscript>
            <strong>We're sorry but vuex-auth-child-routes doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
        
        <div id="wrapper"></div>

        <!-- End of Page Wrapper -->

         <!-- Scripts -->
		<script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
