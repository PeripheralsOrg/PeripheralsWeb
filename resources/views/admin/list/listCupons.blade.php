@extends('layouts.admin')
@section('css', 'admin/listCupons')
@section('title')@parent Lista de Cupons @stop

@section('content')

    <!-- Titulo -->
    <main class="container-cupons">
        <h1>Cupons de Desconto</h1>

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
        <form id="divBusca" action="{{ route('search-cupom') }}" method="GET">
            <input type="text" id="txtBusca" name="search" placeholder="Buscar..." />
            <button type="submit" id="searchIcon"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <!-- FILTROS -->
        <section class="container-filters">
            <button id="btnNewProduto" onclick="window.location.href=`{{ route('page-inserirCupom') }}`">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Novo Cupom
            </button>

            <div class="container-clean-filters box-filter">
                <button id="btnCleanFilters" onclick="window.location.href=`{{ route('page-listCupons') }}`">
                    Limpar Filtros
                </button>
            </div>
        </section>

        <!--Começo_da_tabela_de_pedidos-->
        <table class="table">
            <!-- Header_da_tabela -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Codigo</th>
                    <th>Porcentagem</th>
                    <th>Válido</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>

                @if (!empty($cupons))
                    @foreach ($cupons as $item)
                        <tr>
                            <!-- Conteúdo_da_tabela -->
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['nome'] }}</td>
                            <td>{{ $item['codigo'] }}</td>
                            <td>{{ $item['porcentagem'] }}</td>
                            <td>{{ (new DateTime($item['data_expiracao']))->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $item['status'] = 1 ? 'Ativo' : 'Inativo' }}</td>
                            <td id="box-options">
                                <form action="{{ route('delete-cupom', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                </form>

                                <form action="{{ route('get-cupom', $item['id']) }}" method="GET">
                                    @csrf
                                    <button type="submit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="10">Nenhum cupom encontrado</td>

                @endif
            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>

        </section>

    </main>

@endsection
