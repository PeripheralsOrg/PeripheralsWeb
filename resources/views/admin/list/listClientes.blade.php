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
        <div id="divBusca">
            <input type="text" id="txtBusca" placeholder="Buscar..." />
            <a id="searchIcon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>

        <!--PROMOÇÃO DIARIA-->

        <section class="container-marcador" id="marcador">
            <div class="row">
                <div class="content">
                    <div class="contador">
                        <div class="box">
                            <h3>0</h3>
                            <span>Usuários nas últimas 24 horas</span>
                        </div>
                        <div class="box">
                            <h3>0</h3>
                            <span>Usuários na última semana</span>
                        </div>
                        <div class="box">
                            <h3>0</h3>
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
                        <th>Email</th>
                        <th>CPF</th>
                        <th>DataNasc</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <!-- Corpo_da_tabela -->
                <tbody>
                    <tr>
                        <!-- Conteúdo_da_tabela -->
                        <td>1</td>
                        <td>Salém</td>
                        <td>salém@gmail.com</td>
                        <td>520.052.230</td>
                        <td>19/05/1990</td>
                        <td>Ativo</td>
                        <td><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                    </tr>

                <tbody>
                    <!-- Final_do_corpo_da_tabela -->
            </table>

        </section>

    </main>

@endsection
