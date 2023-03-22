@extends('layouts.admin')
@section('css', 'admin/listMenus')
@section('title')@parent Menus e Submenus @stop

@section('content')

    <!-- Titulo -->
    <main class="container-menus">
        <h1>Menus e Submenus</h1>

        <!-- Barra_de_busca -->
        {{-- <div id="divBusca">
            <input type="text" id="txtBusca" placeholder="Buscar..." />
            <a id="searchIcon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div> --}}

        <!-- FILTROS -->
        {{-- MENU --}}
        <section class="container-filters">
            <button id="btnNewProduto">
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
                <tr>
                    <!-- Conteúdo_da_tabela -->
                    <td>1</td>
                    <td>Stich</td>
                    <td>#</td>
                    <td>Ativo</td>
                    <td id="box-options">
                        <a href="#">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        <a href="#">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>

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
                    <th>Submenu</th>
                    <th>Link do Submenu</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>
                <tr>
                    <!-- Conteúdo_da_tabela -->
                    <td>1</td>
                    <td>Stich</td>
                    <td>Alibaba</td>
                    <td>teclado</td>
                    <td>Ativo</td>
                    <td id="box-options">
                        <a href="#">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        <a href="#">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>

            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>

    </main>

@endsection
