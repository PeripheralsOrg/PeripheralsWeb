@extends('layouts.client')
@section('css', 'home/pesquisa')
@section('js', 'home/pesquisa')
@section('title')@parent Item Pesquisado @stop

@section('content')

    <main class="pesquisa-container">
        {{-- <h1>Pesquisado</h1> --}}

        <section class="wrapper">
            <section class="filters-container">
                <div class="box-filter">
                    <div class="box-filter">
                        <label for="selectOrdem">Ordenar Por</label>
                        <select onchange="submitFilter(this)" name="select-ordem" id="selectOrdem">
                            <option value="quant">Mais Relevantes</option>
                            <option value="DESC">Maior Preço</option>
                            <option value="ASC">Menor Preço</option>
                        </select>
                    </div>

                    <form class="box-filter" method="GET" action="{{ route('produto-maxValue') }}">
                        <label for="maxValue">Valor Máximo</label>
                        <input type="range" name="max-value" id="valueInput" value="1000" min="10" max="10000"
                            step="90">
                        <p>Valor: R$ <output id="value"></output></p>
                        <input type="submit" value="Pesquisar">
                    </form>

                    <label for="selectMarca">Marca</label>
                    <select onchange="submitFilter(this)" name="select-marca" id="selectMarca">
                        <option value="null">Todas</option>
                        @foreach ($marcas as $item)
                            <option value="{{ $item['nome'] }}">{{ $item['nome'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="box-filter">
                    <label for="selectCategoria">Categoria</label>
                    <select onchange="submitFilter(this)" name="select-categoria" id="selectCategoria">
                        <option value="null">Todas</option>
                        @foreach ($categorias as $item)
                            <option value="{{ $item['categoria'] }}">{{ $item['categoria'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="box-filter">
                    <label for="selectAvaliacao">Avaliação</label>
                    <select onchange="submitFilter(this)" name="select-avaliacao" id="selectAvaliacao">
                        <option value="5">5 Estrelas</option>
                        <option value="4">4 Estrelas</option>
                        <option value="3">3 Estrelas</option>
                        <option value="2">2 Estrelas</option>
                        <option value="1">1 Estrelas</option>
                    </select>
                </div>

                <form style="display: none" id="formFilter" action="{{ route('produto-filterClient') }}" method="GET">
                    <input type="hidden" id="selectName" name="selectName">
                    <input type="hidden" id="selectValue" name="selectValue">
                </form>
                <button onclick="window.location.href='{{ route('produtoClient-resetFilter') }}'" id="cleanFilters">Limpar
                    Filtros</button>
            </section>

            <h2 id="titleProd">Produtos Encontrados</h2>

            <section class="produto-container">

                @if (!empty($produtos))

                    @foreach ($produtos as $item)
                        <div style="cursor: pointer;" class="produto-item"
                            onclick="window.location.href=`{{ route('produto-get', $item['id_produtos']) }}`">
                            
                            <img src="{{ $item['link_img'] }}" alt="">
                            <hr>
                            <div class="des">
                                <span>{{ $item['marca'] }}</span>
                                <h5>{{ $item['nome'] }}</h5>
                                <div class="star">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h4>R$ {{ $item['preco'] }}</h4>
                            </div>
                            <div>
                                <a href=""><i class="fa fa-shopping-bag"></i></a>
                                <a href=""><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="container-error">
                        <h1>{{ $erro }}</h1>
                    </div>
                @endif

            </section>
        </section>
    </main>


@endsection
