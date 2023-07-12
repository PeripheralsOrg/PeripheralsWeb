<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Scripts e Stylesheet nativos --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/@yield('css').css">
    <script defer src="{{ asset('js') }}/@yield('js').js"></script>
    {{-- Font Aweasome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

    <title>
        @section('title')
            Peripherals -
        @show
    </title>

</head>

<body>
    <img src="{{asset('images/logo-peripherals.jpeg')}}" alt="Logo Peripherals">

    <section class="container-content">
        @yield('content')
    </section>

</body>
<script src="{{ asset('js/home/client.js') }}"></script>
<script src="{{ asset('js/home/swiper-bundle.min.js') }}"></script>

</html>
