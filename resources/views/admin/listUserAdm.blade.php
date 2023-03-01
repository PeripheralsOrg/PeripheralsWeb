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
            <a id="search-icon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>

        <!-- FILTROS -->
        <section class="container-filters">
            <button id="btn-new-produto">
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
                <tr>
                    <!-- Conteúdo_da_tabela -->
                    <td>1</td>
                    <td>Stich</td>
                    <td>Stich@gmail.com</td>
                    <td>9</td>
                    <td>25/02/2023</td>
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

        </section>

    </main>

@endsection
