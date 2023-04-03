<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/@yield('css').css">
    <script defer src="{{ asset('js') }}/@yield('js').js"></script>
    <script src="{{asset('js/valida-forms.js')}}"></script>
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

        @if (!Request::is('adm/auth/*'))
            <header id="getMenu">
                <img class="img-logo" src="{{ asset('images/logo-branco.png') }}" alt="Peripherals - Logo Branca"
                    id="logo">

                <!-- Barra_de_menu_lateral -->
                <nav id="navLinks">
                    <ul>
                        <li><a href="{{route('page-relatorios')}}">Relatórios</a></li>
                        <li><a href="">Pedidos</a></li>
                        <li><a href="{{route('page-inserirProduto')}}">Produtos</a></li>
                        <li><a href="">Clientes</a></li>
                        <li><a href="">Feedback</a></li>
                        <li><a href="{{route('page-listAdm')}}">Administração</a></li>
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
                <button class="button-nav" id="userSession">Sysadmin: <br> abc@adm.com</button>

                <!-- Encerrar_sessão -->
                <button class="button-nav" id="logoutSession">Logout</button>

            </header>
            <!-- Fim_da_sessão_header -->
            <div class="fix"></div>

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
<script src="{{ asset('js/admin/admin.js') }}"></script>

</html>
