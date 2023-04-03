@extends('layouts.admin')
@section('css', 'admin/listUserAdm')
@section('title')@parent Usuários Administrativos @stop

@section('content')

    <!-- Titulo -->
    <main class="container-users">
        <h1>Usuários Administrativos</h1>

        <!-- Barra_de_busca -->
        <div id="divBusca">
            <input type="text" id="txtBusca" placeholder="Buscar..." />
            <a id="searchIcon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>

        <!-- FILTROS -->
        <section class="container-filters">
            <button id="btnNewProduto" onclick="window.location.href=`{{ route('page-inserirAdm') }}`">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Novo Usuário
            </button>
        </section>

        <!--Começo_da_tabela_de_pedidos-->
        <table class="table">
            <!-- Header_da_tabela -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Poder</th>
                    <th>Data de Criação</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>
                @if (isset($users))

                    @foreach ($users as $item)
                        <tr>
                            <!-- Conteúdo_da_tabela -->
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['poder'] }}</td>
                            <td>{{ (new DateTime($item['created_at']))->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $item['status'] = 1 ? 'Ativo' : 'Inativo' }}</td>
                            <td id="box-options">
                                <form action="{{ route('delete-userAdm', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                        </a>
                                </form>

                                {{-- <a href="{{ route('delete-userAdm', $item['id']) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a> --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="10">{{ $erro }}</td>
                @endif

            <tbody>
                <!-- Final_do_corpo_da_tabela -->
        </table>

        </section>

    </main>

@endsection
