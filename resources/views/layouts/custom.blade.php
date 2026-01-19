<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Coding Test</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
	
	<!-- CSS Libraries -->

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/modules/sweetalert2/sweetalert2.min.css') }}">
	<style>
		.card.card-bg-red {
			border-top: 2px solid #FC695F;
		}
	</style>
	
	@stack('css')

</head>

<body>
	<div id="app">
		<section class="section d-flex align-items-center" style="height: 100vh">
			<div class="container">
				@yield('content')
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

	<!-- Template JS File -->
	<script src="{{ asset('assets/js/scripts.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>

	<script>
		@if (session("alert_type") && session("message"))
			var toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timerProgressBar: true,
				timer: 3000
			});

			toast.fire({
				icon: '{{ session('alert_type') }}',
				title: '{{ session('message') }}'
			})
		@endif
	</script>
	
	<!-- Page Specific JS File -->
	@stack('js')
</body>
</html>
