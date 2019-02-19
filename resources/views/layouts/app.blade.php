<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    @guest
    <style type="text/css">
        body,html{
            height:100%;
        }
    </style>
    @endguest
</head>
<body class="bg-light">
    @guest
    @yield('login')
    @else
    <div id="app">
    @include('layouts.navbartop')
    @include('layouts.flashmessage')
    @yield('breadcrumb')
    @yield('content')
    </div>
    @endguest

  <!--Scripts-->
  <script src="{{asset('js/datatables.js')}}"></script>
  <script src="{{asset('js/popper.js')}}"></script>
  <script src="{{asset('js/bootstrap4.min.js')}}"></script>
  <script src="{{asset('js/validation-form.js')}}"></script>
  <script src="{{asset('js/custom.js')}}"></script>
  @yield('script')

</body>
</html>
