<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" href="{{ asset('img/logo-one-grosir-32x32.webp') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('img/logo-one-grosir-192x192.webp') }}" sizes="192x192">
    
    <title>{{ $title }} | One Grosir Laundry</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">

    <!-- Library CSS -->
    @stack('css-library')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')  }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')  }}">
	<link rel="stylesheet" href="{{ asset('assets/modules/sweetalert2/sweetalert2.min.css') }}">

    <!-- CSS Link -->
    @stack('css-link')

    <!-- CSS Style Custom -->
    @stack('css-custom')
</head>

<body>
    <div id="app">
        <div class="main-wrapper-1">
        <div class="navbar-bg bg-primary" style="height: 55px;"></div>
        <nav class="navbar navbar-expand-lg main-navbar" style="height: 55px;">
            @include('layouts._navbar')
        </nav>

		<div class="main-sidebar sidebar-style-2" style="overflow: hidden; outline: none;">
            @include('layouts._sidebar')
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                @hasSection('page-title')
                    <div class="section-header justify-content-between">
                        <h1>@yield('page-title', 'No Title')</h1>
                        @if (config('app.env') != 'production')
                            <p style="font-size: 15px" class="m-0">Server : <b>{{ config('app.env') }}</b></p>
                        @endif
                        
                        {{-- @include('layouts._breadcrumb') --}}
                    </div>
                @endif

                <div class="section-body">
                    @yield('content')
                </div>
            </section>
        </div>
        <footer class="main-footer">
            @include('layouts._footer')
        </footer>
        </div>
    </div>
    
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.min.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/sweetalert2/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    
    <!-- JS Libraies -->
    @stack('js-library')

    <!-- Custom JS configuration -->
    @stack('js-custom')

    <!-- Page Specific JS File -->
    @stack('js-specific-file')

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
</body>
</html>