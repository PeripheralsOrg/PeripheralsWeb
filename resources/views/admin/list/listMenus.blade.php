@extends('layouts.admin')
@section('css', 'admin/listMenus')
@section('title')@parent Menus e Submenus @stop

@section('content')

    <!-- Titulo -->
    <main class="container-menus">
        <h1>Menus e Submenus</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Barra_de_busca -->
        {{-- <div id="divBusca">
            <input type="text" id="txtBusca" placeholder="Buscar..." />
            <a id="searchIcon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div> --}}

        <!-- FILTROS -->
        {{-- MENU --}}
        <section class="container-filters">
            <button id="btnNewProduto" onclick="window.location.href=`{{ route('page-inserirMenu') }}`">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Novo Menu
            </button>
        </section>

        <!--Começo_da_tabela_de_pedidos-->
        <table class="table">
            <!-- Header_da_tabela -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome do Menu</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>
                @if (isset($menus))
                    @foreach ($menus as $item)
                        <tr>
                            <!-- Conteúdo_da_tabela -->
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['titulo'] }}</td>
                            <td>{{ $item['link_menu'] }}</td>
                            <td>{{ $item['status'] = 1 ? 'Ativo' : 'Inativo' }}</td>
                            <td id="box-options">
                                <form action="{{ route('delete-menu', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                </form>

                                <form action="{{ route('get-menu', $item['id']) }}" method="GET">
                                    @csrf
                                    <button type="submit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="10">{{ $erro }}</td>
                @endif

            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>

        {{-- SUBMENU --}}
        <section class="container-filters">
            <button id="btnNewProduto">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Novo Submenu
            </button>
        </section>

        <!--Começo_da_tabela_de_pedidos-->
        <table class="table">
            <!-- Header_da_tabela -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome do Submenu</th>
                    <th>Menu</th>
                    <th>Link do Submenu</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>
                @if (isset($submenus))
                    @foreach ($submenus as $item)
                        <tr>
                            <!-- Conteúdo_da_tabela -->
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['titulo_submenu'] }}</td>
                            <td>{{ $item['id_menu'] }}</td>
                            <td>{{ $item['link_submenu'] }}</td>
                            <td>{{ $item['status'] = 1 ? 'Ativo' : 'Inativo' }}</td>
                            <td id="box-options">
                                <form action="{{ route('delete-submenu', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                </form>

                                <form action="{{ route('get-submenu', $item['id']) }}" method="GET">
                                    @csrf
                                    <button type="submit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (isset($erroSubmenu))
                    <td colspan="10">{{ $erroSubmenu }}</td>
                @else:
                    <td colspan="10">{{ $erro }}</td>
                @endif

            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>

    </main>

@endsection
