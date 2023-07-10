@extends('layouts.client')
@section('css', 'home/favoritos')
@section('js', 'home/favoritos')
@section('title')@parent Favoritos @stop

@section('content')

    <!-- cards start -->

    <section id="product1" class="section-p1">
        <h2 class="titulo">MINHA LISTA DE DESEJOS</h2>
        <p class="subtitulo">6 itens</p>

        <!-- pro-container_swiper_start -->
        <div class="pro-container">
            <div class="swiper-button-next-produto swiper-navBtn"><i class="fa-solid fa-angle-left"></i></div>

            <!-- slider_swiper-wrapper_start -->

            <div class=" slider swiper-wrapper">


                @for ($i = 0; $i < 6; $i++)
                    <div class="pro swiper-slide">
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
                        <div class="actions-container">
                            <a href=""><i class="fa fa-shopping-bag"></i></a>
                            <a href=""><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                @endfor

            </div>

            <div class="swiper-button-prev-produto swiper-navBtn"><i class="fa-solid fa-angle-right"></i></div>

            <div class="swiper-pagination-produto"></div>

        </div>
        <!-- pro-container_swiper_end -->
    </section>

    <!-- cards end -->


    <!-- cards start -->

    <section id="product1" class="section-p1">
        <h2 class="titulo">Produtos Semelhantes</h2>
        <!-- pro-container_swiper_start -->
        <div class="pro-container">

            <!-- slider_swiper-wrapper_start -->
            <div class="swiper-button-next-produto swiper-navBtn"><i class="fa-solid fa-angle-left"></i></div>

            <div class=" slider swiper-wrapper">


                @for ($i = 0; $i < 6; $i++)
                    <div class="pro item swiper-slide">
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
                        <div class="actions-container">
                            <a href=""><i class="fa fa-shopping-bag"></i></a>
                            <a href=""><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                @endfor

            </div>

            <div class="swiper-button-prev-produto swiper-navBtn"><i class="fa-solid fa-angle-right"></i></div>
            <div class="swiper-pagination-produto"></div>

        </div>
    </section>

    <!-- cards end -->

@endsection
