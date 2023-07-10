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
                        <label for="#">Ordenar Por</label>
                        <select name="#" id="#">
                            <option value="">Opção 1</option>
                        </select>
                    </div>

                    <div class="box-filter">
                        <label for="#">Valor Máximo</label>
                        <input type="range" name="#" id="valueInput" value="1000" min="10" max="10000" step="90">
                        <p>Valor: R$    <output id="value"></output></p>
                        <input type="submit" value="Pesquisar">
                    </div>

                    <label for="#">Marca</label>
                    <select name="#" id="#">
                        <option value="">Opção 1</option>
                    </select>
                </div>

                <div class="box-filter">
                    <label for="#">Categoria</label>
                    <select name="#" id="#">
                        <option value="">Opção 1</option>
                    </select>
                </div>

                <div class="box-filter">
                    <label for="#">Avaliação</label>
                    <select name="#" id="#">
                        <option value="">Opção 1</option>
                    </select>
                </div>

                <button id="cleanFilters">Limpar Filtros</button>
            </section>

            <h2 id="titleProd">Produtos Encontrados</h2>

            <section class="produto-container">

                @for ($i = 0; $i < 15; $i++)
                    <div class="produto-item">
                        <img src="{{ asset('images/JFC172_01.jpg') }}" alt="">
                        <hr>
                        <div class="des">
                            <span>MULTILASER</span>
                            <h5>Mouse Gamer</h5>
                            <div class="star">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>R$ 120,00</h4>
                        </div>
                        <div>
                            <a href=""><i class="fa fa-shopping-bag"></i></a>
                            <a href=""><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                @endfor



            </section>
        </section>
    </main>


@endsection
