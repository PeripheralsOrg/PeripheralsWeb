@extends('layouts.admin')
@section('css', 'admin/listPedidos')
@section('js', 'admin/listPedidos')
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
        <form id="divBusca" action="{{ route('search-pedidos') }}" method="post">
            @method('POST')
            @csrf
            <input type="text" id="txtBusca" name="search" placeholder="Busque pelo ID" />
            <button type="submit" id="searchIcon"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <section class="container-filters">

            <form class="box-input-date" action="{{ route('filter-pedidosDate') }}">
                <div class="box-ordem box-filter">
                    <label for="inputDateFrom">De:</label>
                    <input required type="date" name="dateFrom" id="inputDateFrom">
                </div>

                <div class="box-ordem box-filter">
                    <label for="inputDateTo">Até:</label>
                    <input required type="date" name="dateTo" id="inputDateTo">
                </div>

                <div class="box-ordem box-filter">
                    {{-- ! CARACTEREZE INVISIVISIVEL, NÃO MEXER --}}
                    <label for="inputDateTo">⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>

                    <button id="btnNewProduto">
                        Pesquisar
                    </button>
                </div>
                </div>
            </form>


            <form class="box-ordem box-filter" id="formFilter" action="{{ route('filter-pedidosOrdem') }}">
                <label for="selectOrdem">Ordenar Por</label>
                <select id="selectOrdem" onchange="submitFilter(this)" name="select-ordem">
                    <option>Todos</option>
                    <option value="DESC">Maior Preço</option>
                    <option value="ASC">Menor Preço</option>
                    <option value="quant">Mais Relevante</option>
                </select>
            </form>

            <div class="container-clean-filters box-filter">
                <button id="btnCleanFilters" onclick="window.location.href=`{{ route('page-listPedidos') }}`">
                    Limpar Filtros
                </button>
            </div>
            </div>
        </section>

        <!--Começo_da_tabela_de_pedidos-->
        <table class="table">
            <!-- Header_da_tabela -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subtotal</th>
                    <th>Frete</th>
                    <th>Itens</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>
                @if (isset($getVenda) && count($getVenda) > 0)
                    @foreach ($getVenda as $item)
                        <tr>
                            <!-- Conteúdo_da_tabela -->
                            <td>{{ $item['id_venda'] }}</td>
                            <td>{{ $item['valor_total'] }}</td>
                            <td>{{ $item['frete'] }}</td>
                            <td>{{ $item['quantidade_items'] }}</td>
                            <td>{{ Carbon\Carbon::parse($item['created_at'])->format('d/m/Y h:i:s') }}</td>
                            <td><a href="{{ route('get-detailsPedidos', $item['id_venda']) }}"><i
                                        class="fa-solid fa-magnifying-glass"></i></a></td>
                        </tr>
                    @endforeach
                @else
                    <h1>{{ $erro }}</h1>
                @endif


            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>
    </main>
@endsection
