<!DOCTYPE html>
<html lang="id">

@include('landing-page.partials.head')

<body>
   @include('landing-page.partials.navbar')

   @yield('content')

   @include('landing-page.partials.footer')

   @include('landing-page.partials.scripts')

   @stack('scripts')
</body>

</html>
