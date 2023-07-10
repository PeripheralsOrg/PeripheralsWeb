@extends('layouts.admin')
@section('css', 'admin/listProdutos')
@section('js', 'admin/listProdutos')
@section('title')@parent Lista de Produtos @stop


@section('content')

    <!-- Titulo -->
    <main class="container-produtos">
        <h1>Produtos</h1>

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
        <form id="divBusca" action="{{ route('search-produto') }}" method="GET">
            <input type="text" id="txtBusca" name="search" placeholder="Buscar..." />
            <button type="submit" id="searchIcon"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <section class="container-filters">
            <button id="btnNewProduto" onclick="window.location.href=`{{ route('page-inserirProduto') }}`">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Novo Produto
            </button>

            <div class="box-status box-filter">
                <label for="selectStatus">Status</label>
                <select id="selectStatus" onchange="submitFilter(this)" name="select-status">
                    <option>Todos</option>
                    <option value="1">Disponivel</option>
                    <option value="0">Indisponivel</option>
                </select>
            </div>

            <div class="box-faixa-preco box-filter">
                <label for="boxSelectCategoria">Categorias</label>
                <select id="boxSelectCategoria" onchange="submitFilter(this)" name="select-categoria">
                    <option>Todos</option>
                    <option value="Monitor">Monitor</option>
                    <option value="Teclado">Teclado</option>
                </select>
            </div>

            <div class="box-ordem box-filter">
                <label for="selectOrdem">Ordenar Por</label>
                <select id="selectOrdem" onchange="submitFilter(this)" name="select-ordem">
                    <option>Todos</option>
                    <option value="DESC">Maior Preço</option>
                    <option value="ASC">Menor Preço</option>
                    <option value="quant">Mais Relevante</option>
                </select>
            </div>

            <form style="display: none" id="formFilter" action="{{ route('produto-filter') }}" method="GET">
                <input type="hidden" id="selectName" name="selectName">
                <input type="hidden" id="selectValue" name="selectValue">
            </form>

            <div class="container-clean-filters box-filter">
                <button id="btnCleanFilters" onclick="window.location.href=`{{ route('produto-resetFilter') }}`">
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
                    <th>Categoria</th>
                    <th>Marca</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            {{-- TODO: #39 Exibir a data de criação do produto --}}
            <tbody>
                @if (!empty($produtos))
                    @foreach ($produtos as $item)
                        <tr>
                            <!-- Conteúdo_da_tabela -->
                            <td>{{ $item['id_produtos'] }}</td>
                            <td>{{ $item['nome'] }}</td>
                            <td>{{ $item['categoria'] }}</td>
                            <td>{{ $item['marca'] }}</td>
                            <td>{{ $item['preco'] }}</td>
                            <td>{{ $item['status'] === 1 ? 'Ativo' : 'Inativo' }}</td>
                            <td id="box-options">
                                <form action="{{ route('delete-produto', $item['id_produtos']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                                <form action="{{ route('get-produto', $item['id_produtos']) }}" method="GET">
                                    @csrf
                                    <button type="submit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="10">Nenhum Produto encontrado!</td>
                @endif

            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>
        @if (!empty($produtos))
            <div class="mt-4 p-4 box has-text-centered">
                @if (!is_array($produtos))
                    {{ $produtos->links('pagination::default') }}
                @endif
            </div>
        @endif
        </section>

    </main>

@endsection
