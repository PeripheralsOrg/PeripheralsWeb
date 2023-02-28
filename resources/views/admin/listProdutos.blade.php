@extends('layouts.admin')
@section('css', 'admin/listProdutos')
@section('title')@parent Lista de Produtos @stop


@section('content')

    <!-- Titulo -->
    <main class="container-produtos">
        <h1>Produtos</h1>

        <!-- Barra_de_busca -->
        <div id="divBusca">
            <input type="text" id="txtBusca" placeholder="Buscar..." />
            <a id="search-icon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>

        <section class="container-filters">
                <button id="btn-new-produto">
                    <div class="icon-container">
                        <i class="fa-regular fa-plus"></i>
                    </div>
                    Novo Produto
                </button>

                <div class="box-status box-filter">
                    <label for="select-status">Status</label>
                    <select id="select-status" name="select-status">
                        <option>Todos</option>
                        <option value="1">Disponivel</option>
                        <option value="0">Indisponivel</option>
                    </select>
                </div>

                <div class="box-faixa-preco box-filter">
                    <label for="select-faixa-preco">Categorias</label>
                    <select id="boselectx-categoria" name="select-faixa-preco">
                        <option>Todos</option>
                    </select>
                </div>

                <div class="box-ordem box-filter">
                    <label for="select-ordem">Ordenar Por</label>
                    <select id="select-ordem" name="select-ordem">
                        <option>Todos</option>
                        <option value="1">Maior Preço</option>
                        <option value="2">Menor Preço</option>
                        <option value="3">Mais Relevante</option>
                    </select>
                </div>

                <div class="container-clean-filters box-filter">
                    <button id="btn-clean-filters">
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
                    <th>Quantidade</th>
                    <th>Valor</th>
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
