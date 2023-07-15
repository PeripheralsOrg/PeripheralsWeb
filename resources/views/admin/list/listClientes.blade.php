@extends('layouts.admin')
@section('css', 'admin/listClientes')
@section('title')@parent Lista de Clientes @stop


@section('content')

    <!-- Titulo -->
    <main class="container-clientes">
        <h1>Clientes</h1>

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

        <!--PROMOÇÃO DIARIA-->

        <section class="container-marcador" id="marcador">
            <div class="row">
                <div class="content">
                    <div class="contador">
                        <div class="box">
                            <h3>{{ $countUsersToday }}</h3>
                            <span>Usuários nas últimas 24 horas</span>
                        </div>
                        <div class="box">
                            <h3>{{ $countUsersWeek }}</h3>
                            <span>Usuários na última semana</span>
                        </div>
                        <div class="box">
                            <h3>{{ $countUsersMonth }}</h3>
                            <span>Usuários no último mês</span>
                        </div>
                    </div>
                </div>
            </div>


            <!--Começo_da_tabela_de_pedidos-->
            <table class="table">

                <!-- Header_da_tabela -->
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Último nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Telefone Celular</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <!-- Corpo_da_tabela -->
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <!-- Conteúdo_da_tabela -->
                            <td>{{$item['id']}}</td>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['last_name']}}</td>
                            <td>{{$item['email']}}</td>
                            <td>{{$item['cpf'] ? $item['cpf'] : "-"}}</td>
                            <td>{{$item['telefone_celular'] ? $item['email'] : "-"}}</td>
                            <td>{{$item['status'] ? 'Ativo' : "Desativado"}}</td>
                            <td><a href="{{route('page-getCliente', $item['id'])}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                        </tr>
                    @endforeach

                <tbody>
                    <!-- Final_do_corpo_da_tabela -->
            </table>

        </section>

    </main>

@endsection
