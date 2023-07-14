@extends('layouts.client')
@section('css', 'home/favoritos')
@section('js', 'home/favoritos')
@section('title')@parent Favoritos @stop

@section('content')

    <!-- cards start -->

    <section id="product1" class="section-p1">
        <h2 class="titulo">MINHA LISTA DE DESEJOS</h2>
        @if (!empty($favoritos))
            <p class="subtitulo">{{ count($favoritos) }} itens</p>
            <div class="pro-containerT">
                @foreach ($favoritos as $item)
                    <div class="pro item" onclick="window.location.href=`{{ route('produto-get', $item['id_produtos']) }}`">
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
                        <div class="actions-container">
                            <a href="{{ route('carrinho-insert', $item['id_produtos']) }}"><i
                                    class="fa fa-shopping-bag"></i></a>

                            <a href="{{ route('favoritar-produto', $item['id_produtos']) }}"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <h1 id="errorTitle">{{ $erro }}</h1>
        @endif

        @if ($errors->any())
            <div class="container-error">
                <i class="fa-sharp fa-solid fa-circle-exclamation" style="color: #FFFF;"></i>
                @foreach ($errors->all() as $error)
                    <p id="txt-error">
                        {{ $error }}
                    </p>
                @endforeach
            </div>
        @endif
    </section>

    <!-- cards end -->


    <!-- cards start -->

    <section id="product1" class="section-p1">
        <h2 class="titulo">Produtos Semelhantes</h2>
        <!-- pro-container_swiper_start -->
        @if (!empty($getAllProd))

            <div class="pro-container">

                <!-- slider_swiper-wrapper_start -->
                <div class="swiper-button-next-produto swiper-navBtn"><i class="fa-solid fa-angle-left"></i></div>

                <div class=" slider swiper-wrapper">

                    @foreach ($getAllProd as $item)
                        <div class="pro item swiper-slide"
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
                            <div class="actions-container">
                                <a href="{{ route('carrinho-insert', $item['id_produtos']) }}"><i
                                        class="fa fa-shopping-bag"></i></a>

                                <a href="{{ route('favoritar-produto', $item['id_produtos']) }}"><i
                                        class="fa fa-heart"></i></a>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="swiper-button-prev-produto swiper-navBtn"><i class="fa-solid fa-angle-right"></i></div>
                <div class="swiper-pagination-produto"></div>

            </div>
        @else
            <h1 id="errorTitle">{{ $erro }}</h1>
        @endif
    </section>

    <!-- cards end -->

@endsection
