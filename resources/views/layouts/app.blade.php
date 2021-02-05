<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Minigram</title>

    <!-- CSS Vendor -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <link
      rel="shortcut icon"
      href="source/images/logo.png"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="{{ asset('source/font-awasome/css/all.css') }}" />
    <link
      href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"
      rel="stylesheet"
    />

    <!-- CSS Custom -->
    <link rel="stylesheet" href="{{ asset('source/css/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('source/images/logo.png') }}" type="image/x-icon">
  </head>
  <body>
    <!-- Navbar -->
    @if (auth()->user() && auth()->user()->email_verified_at)
    @include('layouts.navbar')
    @endif

    @yield('content')
    @include('sweetalert::alert')


    <!-- Footer -->
    @if (auth()->user() && auth()->user()->email_verified_at)
    <p class="text-center text-secondary">
      &copy; Copyright 2021 - Maulana Fajar Ibrahim
    </p>
    @endif

    <!-- Javascript Vendor -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Custom Javascript -->
    <script src="{{ asset('source/js/script.js') }}"></script>

    @yield('pageScript');
  </body>
</html>
