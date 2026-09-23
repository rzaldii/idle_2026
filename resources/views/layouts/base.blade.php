<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="{{ asset('favicon/favicon-32x32.png') }}" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{asset('favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700,900|Lato:400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">

    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/--mp---navbar-shrinking-on-scroll.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Horizontal-scrolling-cards-for-mobile-apps.css') }}">

    <!-- Libraries CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">

    <!-- Main Stylesheet File -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/idle-design-system.css') }}">
    <style>
      html {
        scroll-behavior: smooth;
      }
    </style>

@yield('css')

</head>

<body>

<!-- Fixed navbar -->
@include('includes.navbar')

@yield('content')

<!-- *****************************************************************************************************************
   FOOTER
   ***************************************************************************************************************** -->
@include('includes.footer')

<!-- / copyrights -->

<!-- JavaScript Libraries -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bs-init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
<script src="{{ asset('assets/js/--mp---navbar-shrinking-on-scroll.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Template Main Javascript File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "showDuration": "5000",
      "hideDuration": "300",
      "timeOut": "5000",
      "extendedTimeOut": "3000"
    }

    @if($message = Session::get('error'))
    toastr.error('{{ $message }}', 'Error')
    @endif

    @if($message = Session::get('success'))
    toastr.success('{{ $message }}', 'Success')
    @endif
</script>

@yield('js')

</body>
</html>
