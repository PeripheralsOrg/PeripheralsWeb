@extends('layouts.admin')
@section('css', 'admin/listComentarios')
@section('title')@parent Lista de Comentários @stop

@section('content')
    <main class="container-comentarios">

        <h1>Feedback</h1>

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
        <section class="container-filters">
            <form class="box-input-date" action="{{ route('filter-feedbackDate') }}">
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


            <div class="container-clean-filters box-filter">
                <button id="btnCleanFilters" onclick="window.location.href='{{ route('page-listComentarios') }}'">
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
                    <th>Avaliação</th>
                    <th>ID Usuário</th>
                    <th>ID Produto</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo_da_tabela -->
            <tbody>
                @if (!empty($avaliacoes))

                    @foreach ($avaliacoes as $item)
                        <tr>
                            <td>{{ $item['id_comentario'] }}</td>
                            <td>{{ $item['avaliacao'] }} Estrelas</td>
                            <td>{{ $item['id_users'] }}</td>
                            <td>{{ $item['id_produto'] }}</td>
                            <td>{{ Carbon\Carbon::parse($item['created_at'])->format('d/m/Y h:i:s') }}</td>
                            <td>1</td>
                            <td><a href="{{ route('get-comentario', $item['id_comentario']) }}"><i
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
