<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div class="page-wrapper flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="card p-4 rounded">
              @yield('content')
            </div>

            <p class="text-center text-info text-small text-mute"> <strong> &copy; 2018 Developed By Group 7. All Rights Reserved</strong> </p>
          </div>
        </div>
      </div>
    </div>

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/popper.js/popper.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('js/carbon.js') }}"></script>
  <script src="{{ asset('js/demo.js') }}"></script>
  </body>
  </html>
