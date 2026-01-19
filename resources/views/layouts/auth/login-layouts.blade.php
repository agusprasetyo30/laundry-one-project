<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }} | Borwita x Reckitt Integration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth/custom-login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/sweetalert2/sweetalert2.min.css') }}">

    <link rel="icon" href="{{ asset('assets/img/borwitareckitt.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('assets/img/borwitareckitt.png') }}" sizes="192x192">
    @stack('css-custom')
</head>

<body>
    @yield('content')

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>

    <!--- Upload library -->
    @stack('js-library')

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

    <!-- Custom JS configuration -->
    @stack('js-custom')
</body>

</html>