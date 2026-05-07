<!DOCTYPE html>
<html lang="en">
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Forum Lingkar Merapi</title>	

		<meta name="keywords" content="Forum Lingkar Merapi" />
		<meta name="description" content="Forum Lingkar Merapi">
		<meta name="author" content="forum lingkar merapi">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('depan/img/favicon.ico') }}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ asset('depan/img/apple-touch-icon.png') }}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('depan/vendor/bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('depan/vendor/fontawesome-free/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('depan/vendor/animate/animate.compat.css') }}">
		<link rel="stylesheet" href="{{ asset('depan/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('depan/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('depan/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
		<link rel="stylesheet" href="{{ asset('depan/vendor/magnific-popup/magnific-popup.min.css') }}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('depan/css/theme.css') }}">
		<link rel="stylesheet" href="{{ asset('depan/css/theme-elements.css') }}">
		<link rel="stylesheet" href="{{ asset('depan/css/theme-blog.css') }}">
		<link rel="stylesheet" href="{{ asset('depan/css/theme-shop.css') }}">

		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="{{ asset('depan/css/skins/skin-corporate-5.css') }}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('depan/css/custom.css') }}">

	</head>
	<body data-plugin-page-transition>
		<div class="body">
			@include('layout.depan.header')
            @yield('content')
			@include('layout.depan.footer')
		</div>

		<!-- Vendor -->
		<script src="{{ asset('depan/vendor/plugins/js/plugins.min.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('depan/js/theme.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ asset('depan/js/custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ asset('depan/js/theme.init.js') }}"></script>

	</body>
</html>
