<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Clean Blog - Start Bootstrap Theme</title>


  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <!--link href="css/clean-blog.min.css" rel="stylesheet"-->
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

</head>

<body>
    @if (!\Request::is('login') && !\Request::is('register')&& !\Request::is('register/creat'))
        @include('partial.navbar')
    @endif



    @yield('content')

    @if (!\Request::is('login') && !\Request::is('register')&& !\Request::is('register/creat'))
        @include('partial.footer')
    @endif


  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{asset('js/clean-blog.js')}}"></script>
<!--script src="/js/app.js"></script-->
    <!-- Scripts -->
    {{-- <!--script src="{{ asset('js/app.js') }}" defer></script--> --}}
</body>

</html>
