@extends('layouts.admin')
@section('css', 'admin/listConfig')
@section('title')@parent Configurações @stop

@section('content')

    <!-- Titulo -->
    <main class="container-config">
        <h1>Configurações</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ! Categorias --}}

        <!-- FILTROS -->
        <section class="container-filters">
            <button id="btnNewProduto" onclick="window.location.href=`{{ route('page-inserirCategoria') }}`">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Nova Categoria
            </button>
        </section>

        <!--Começo_da_tabela_de_pedidos-->
        <table class="table">
            <!-- Header_da_tabela -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>

                @if (!empty($categorias))
                    @foreach ($categorias as $item)
                        <tr>
                            <!-- Conteúdo_da_tabela -->
                            <td>{{ $item['id_categoria'] }}</td>
                            <td>{{ $item['categoria'] }}</td>
                            <td id="box-options">
                                <form action="{{ route('delete-categoria', $item['id_categoria']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                </form>

                                <form action="{{ route('get-categoria', $item['id_categoria']) }}" method="GET">
                                    @csrf
                                    <button type="submit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                 @if (isset($erroCategorias))
                    <td colspan="10">{{ $erroCategorias }}</td>
                @endif
                @if (isset($erro))
                    <td colspan="10">{{ $erro }}</td>
                @endif
            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>

        {{-- ! Marcas --}}

        <!-- FILTROS -->
        <section class="container-filters">
            <button id="btnNewProduto" onclick="window.location.href=`{{ route('page-inserirMarca') }}`">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Nova Marca
            </button>
        </section>

        <!--Começo_da_tabela_de_pedidos-->
        <table class="table">
            <!-- Header_da_tabela -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>

                @if (!empty($marcas))
                    @foreach ($marcas as $item)
                        <tr>
                            <!-- Conteúdo_da_tabela -->
                            <td>{{ $item['id_marca'] }}</td>
                            <td>{{ $item['nome'] }}</td>
                            <td>{{ $item['status'] = 1 ? 'Ativo' : 'Inativo' }}</td>
                            <td id="box-options">
                                <form action="{{ route('delete-marca', $item['id_marca']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                </form>

                                <form action="{{ route('get-marca', $item['id_marca']) }}" method="GET">
                                    @csrf
                                    <button type="submit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (isset($erroMarcas))
                    <td colspan="10">{{ $erroMarcas }}</td>
                @endif
                @if (isset($erro))
                    <td colspan="10">{{ $erro }}</td>
                @endif
            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>

    </main>

@endsection
