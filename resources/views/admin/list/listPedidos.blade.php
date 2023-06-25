@extends('layouts.admin')
@section('css', 'admin/listPedidos')
@section('title')@parent Lista de Pedidos @stop

@section('content')
    <main class="container-pedidos">

        <h1>Lista de Pedidos</h1>

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
        <form id="divBusca" action="{{ route('search-adm') }}" method="GET">
            <input type="text" id="txtBusca" name="search" placeholder="Buscar..." />
            <button type="submit" id="searchIcon"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <section class="container-filters">

            <section class="box-input-date">
                <div class="box-ordem box-filter">
                    <label for="inputDateFrom">De:</label>
                    <input type="date" name="date" id="inputDateFrom">
                </div>

                <div class="box-ordem box-filter">
                    <label for="inputDateTo">Até:</label>
                    <input type="date" name="date" id="inputDateTo">
                </div>
            </section>

            <div class="box-faixa-preco box-filter">
                <label for="boxSelectCategoria">Categorias</label>
                <select id="boxSelectCategoria" name="select-faixa-preco">
                    <option>Todos</option>
                </select>
            </div>

            <div class="box-ordem box-filter">
                <label for="selectOrdem">Ordenar Por</label>
                <select id="selectOrdem" name="select-ordem">
                    <option>Todos</option>
                    <option value="1">Maior Preço</option>
                    <option value="2">Menor Preço</option>
                </select>
            </div>

            {{-- <div class="container-clean-filters box-filter">
                <button id="btnCleanFilters">
                    Limpar Filtros
                </button> --}}
            </div>
        </section>

        <!--Começo_da_tabela_de_pedidos-->
        <table class="table">
            <!-- Header_da_tabela -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Produto</th>
                    <th>Data</th>
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
                    <td>Mouse</td>
                    <td>23/02/2023</td>
                    <td>1</td>
                    <td><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                </tr>

            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>
    </main>
@endsection
