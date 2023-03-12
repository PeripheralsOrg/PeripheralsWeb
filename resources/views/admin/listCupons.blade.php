@extends('layouts.admin')
@section('css', 'admin/listCupons')
@section('title')@parent Lista de Cupons @stop

@section('content')

    <!-- Titulo -->
    <main class="container-cupons">
        <h1>Cupons de Desconto</h1>

        <!-- Barra_de_busca -->
        <div id="divBusca">
            <input type="text" id="txtBusca" placeholder="Buscar..." />
            <a id="searchIcon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>

        <!-- FILTROS -->
        <section class="container-filters">
            <button id="btnNewProduto">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Novo Cupom
            </button>
        </section>

        <!--Começo_da_tabela_de_pedidos-->
        <table class="table">
            <!-- Header_da_tabela -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Cupom</th>
                    <th>Categoria</th>
                    <th>Válido</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>
                <tr>
                    <!-- Conteúdo_da_tabela -->
                    <td>1</td>
                    <td>Mouse Razer</td>
                    <td>Mouse</td>
                    <td>50</td>
                    <td>R$100,00</td>
                    <td>Disponivel</td>
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
