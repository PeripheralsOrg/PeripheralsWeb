@extends('layouts.client')
@section('css', 'home/categorias')
@section('title')@parent Categorias @stop

@section('content')

    <!-- cards start -->
    @php
        $i = 0;
    @endphp

    @if (!empty($arrayProdutos))
        @foreach ($arrayProdutos as $getProduto)
            @php
                $i++;
            @endphp
            <section id="product1" class="section-p1">
                <div class="container-info">
                    <span class="same-line">

                        <h2 class="titulo">{{ $getCategoriasValues[$i - 1] }}</h2>
                    </span>
                    <a class="link" href="{{ route('produtoCategoria-maxValue', $getCategoriasValues[$i - 1]) }}">
                        Veja todos ></a>
                </div>
                <div class="pro-container">
                    @foreach ($getProduto as $itemProd)
                        <div class="pro item">
                            <img src="{{ $itemProd['link_img'] }}" alt="">
                            <hr>
                            <div class="des">
                                <span>{{ $itemProd['marca'] }}</span>
                                <h5>{{ $itemProd['nome'] }}</h5>
                                <div class="star">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h4>R$ {{ $itemProd['preco'] }}</h4>
                            </div>
                            <div>
                                <a href="{{ route('carrinho-insert', $itemProd['id_produtos']) }}"><i
                                        class="fa fa-shopping-bag"></i></a>

                                <a href="{{ route('favoritar-produto', $itemProd['id_produtos']) }}"><i
                                        class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

    @endif

@endsection
