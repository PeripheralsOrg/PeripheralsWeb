<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/@yield('css').css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/navbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <title>
        @section('title')
            Peripherals -
        @show
    </title>

</head>

<body>
    <main class="global-wrapper">

        @if (!Request::is('login/*'))
            <header>
                <img class="img-logo" src="{{ asset('images/logo-branco.png') }}" alt="Peripherals - Logo Branca"
                    id="logo">

                <!-- Barra_de_menu_lateral -->
                <nav id="nav-links">
                    <ul>
                        <li><a href="">Pedidos</a></li>
                        <li><a href="">Produtos</a></li>
                        <li><a href="">Clientes</a></li>
                        <li><a href="">Feedback</a></li>
                        <li><a href="">Administração</a></li>
                        <div class="dropdown-link">
                            <button class="btn-config">Configurações▾</button>
                            <!-- <i class="fa-solid fa-angle-down"></i> -->
                            <li class="dropdown-content">
                                <a href="">Menus</a>
                                <a href="">Carrossel</a>
                                <a href="">Cupons</a>
                            </li>
                        </div>
                    </ul>
                </nav>
                <!-- Fim_Barra_de_menu_lateral -->

                <!-- ADM_logado -->
                <button class="button-nav" id="user-session">Cargo: <br> abc@adm.com</button>

                <!-- Encerrar_sessão -->
                <button class="button-nav" id="logout-session">Logout</button>

            </header>
            <!-- Fim_da_sessão_header -->
            <section class="container-content">
                @yield('content')
            </section>
        @else
            <section class="container-login">
                @yield('content')
            </section>
        @endif


    </main>
</body>

</html>
