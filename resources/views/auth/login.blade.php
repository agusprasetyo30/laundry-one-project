@extends('layouts.auth.login-layouts', ['title' => 'Login Area'])

@push('css')
    <style>
        .input-disabled-custom[readonly], .input-disabled-custom[disabled] {
            background:#f3f3f3;
            border-color:#d9d9d9;
            color:#b7b7b7;
            /* cursor: not-allowed; */
        }
    </style>
@endpush

@section('content')
    <div class="card card-custom" style="max-width: 500px">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                <h1 class="text-center" style="font-size:18px; font-weight:400; color:#2a2a2a; margin-bottom:0.25rem;">
                    {{-- Borwita x Reckitt Integration --}}
                    <img src="{{ asset('assets/img/logo-bcp-reckitt.png') }}" alt="" srcset="">
                </h1>
                <p class="text-center" style="font-size:12px; font-weight:300; color:#8a8a8a; margin-bottom:1.5rem;">
                    Log in to your account to continue.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-md-6 col-sm-12">
                <form action="{{ route('login') }}" method="post" id="form-login">
                    @csrf
                    <input type="text" name="kode_cabang" hidden>
                    <input type="text" name="token_hasil" id="token_hasil" hidden>
                    <input type="text" name="index" id="index" value="0" hidden>
                    <input type="text" name="time" id="timer" value="0" hidden>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control input-disabled-custom @error('username') is-invalid @enderror" name="username" id="username" autocomplete="off">
                        @error('username')
                            <small class="text-danger">* {{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control input-disabled-custom @error('password') is-invalid @enderror" name="password" id="password" autocomplete="off">
                        @error('password')
                            <small class="text-danger">* {{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" id="btn-login" class="btn btn-primary btn-block mt-4">
                        Log In
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js-custom')
    <script type="module" src="{{ asset('js/auth/login.js') }}"></script>

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
@endpush