@extends('layouts.client')
@section('css', 'home/homepage')
@section('js', 'home/homepage')
@section('title')@parent Homepage @stop
<script defer src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>

@section('content')
{{-- <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="{{asset('bootstrap/bootstrap.min.js')}}"></script> --}}


    <!-- carousel starts  -->

    {{-- Carrossel de Imagens --}}

    <section class="box-carrossel embla">
        <button class="embla__prev banner_prev"><i class="fa-solid fa-arrow-left fa-2x"></i></button>

        <div class="embla__viewport banner_viewport">
            <div class="embla__container">
                @for ($i = 0; $i < 4; $i++)
                    <img style="width:100% !important" src="{{ asset('images/img1.jpg') }}" alt="">
                @endfor
            </div>
        </div>
        <button class="embla__next banner_next"><i class="fa-solid fa-arrow-right fa-2x"></i></button>
    </section>

    <!-- carousel ends -->

    <!-- services starts -->

    <main>


        <section class="service">
            <div class="container-services">

                <ul class="service-list">

                    <li class="service-item">
                        <div class="service-item-icon">
                            <img src="{{ asset('images/icons/Entrega.svg') }}" alt="Service icon">

                        </div>

                        <div class="service-content">
                            <p class="service-item-title">Entrega Gratuita</p>

                            <p class="service-item-text">Em pedidos acima de $900</p>
                        </div>
                    </li>

                    <li class="service-item">
                        <div class="service-item-icon">
                            <img src="{{ asset('images/icons/devolucao.svg') }}" alt="Service icon">
                        </div>

                        <div class="service-content">
                            <p class="service-item-title">Aceitamos Devoluções</p>

                            <p class="service-item-text">Política de Devolução de 30 Dias</p>
                        </div>
                    </li>

                    <li class="service-item">
                        <div class="service-item-icon">
                            <img src="{{ asset('images/icons/Cartao-protegido.svg') }}" alt="Service icon">
                        </div>

                        <div class="service-content">
                            <p class="service-item-title">Segurança de Pagamento</p>

                            <p class="service-item-text">100% Segurança Garantida</p>
                        </div>
                    </li>

                    <li class="service-item">
                        <div class="service-item-icon">
                            <img src="{{ asset('images/icons/suporte.svg') }}" alt="Service icon">
                        </div>

                        <div class="service-content">
                            <p class="service-item-title">Suportes</p>

                            <p class="service-item-text">24/7 Suporte</p>
                        </div>
                    </li>

                </ul>

            </div>
        </section>

        <!-- services end -->

        <!-- cards start -->

        <section id="product1" class="section-p1">
            <h2 class="titulo">Lançamentos</h2>
            <div class="pro-container">
                <section class="produto-carrossel embla">
                    <button class="embla__prev produto_prev"><i class="fa-solid fa-arrow-left fa-2x"></i></button>
            
                    <div class="embla__viewport produto_viewport">
                        <div class="embla__container produto_embla_container">
                            @for ($i = 0; $i < 5; $i++)
                            <div class="pro item">
                                <img src="{{ asset('images/mou_4.jpg') }}" alt="">
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
                        </div>
                    </div>

                    <!-- Slide Template -->
                    <script type="text/template" id="embla-slide-template">
                        <div class="embla__slide">
                        <div class="embla__slide__inner">
                            <img class="embla__slide__img" src="media/media-__img-nr__.jpeg" />
                            <div class="embla__slide__number">__slide-nr__</div>
                        </div>
                        </div>
                    </script>

                    <!-- Loading Template -->
                    <script type="text/template" id="embla-loading-template">
                        <div class="embla__slide embla__slide--loading">
                        <div class="embla__slide__inner embla__slide__inner--loading">
                            <div class="embla__slide__loading"></div>
                        </div>
                        </div>
                    </script>
                    
                    <button class="embla__next produto_next"><i class="fa-solid fa-arrow-right fa-2x"></i></button>
                </section>
            </div>
        </section>

        <!-- cards end -->

        <!-- advertising start -->


        <section class="banner-container">
            <h2 class="title">Confira</h2>

            <div class="box-banners">
                <div class="banner">

                    <img src="{{ asset('images/JFC172_01.jpg') }}" alt="">
                    <div class="content">
                        <span>Novo Headset</span>
                        <h3>Gamer</h3>
                        <a href="#" class="btn">Confira</a>
                    </div>
                </div>
                <div class="banner">
                    <img src="{{ asset('images/JFC172_01.jpg') }}" alt="">
                    <div class="content">
                        <span>Novo Teclado</span>
                        <h3>Gamer</h3>
                        <a href="#" class="btn">Confira</a>
                    </div>
                </div>
            </div>


        </section>

        <!-- advertising end -->



        <!-- cards start -->

        <section id="product1" class="section-p1">

            <h2 class="titulo">Lançamentos</h2>
            <div class="pro-container">
                <section class="produto-carrossel embla">
                    <button class="embla__prev"><i class="fa-solid fa-arrow-left fa-2x"></i></button>
            
                    <div class="embla__viewport">
                        <div class="embla__container">
                            @for ($i = 0; $i < 5; $i++)
                            <div class="pro item">
                                <img src="{{ asset('images/mou_4.jpg') }}" alt="">
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
                        </div>
                    </div>
                    <button class="embla__next"><i class="fa-solid fa-arrow-right fa-2x"></i></button>
                </section>
            </div>
        </section>

        <!-- cards end -->


        <!-- ad starts -->


        <div class="ad-container">
            <h2 class="title">Imperdivel</h2>

            <div class="ad">
                <div class="monitor">
                    <img src="{{ asset('images/quartz 02.webp') }}" alt="">
                </div>
                <div class="content">
                    <span>corra</span>
                    <h3>50% 0ff</h3>
                    <p>oferta imperdivel</p>
                    <a href="#" class="btn-ad">Visualizar oferta</a>
                </div>
                <div class="women">
                    <img src="{{ asset('images/women.png') }}" alt="">
                </div>
            </div>

        </div>

        <!-- ad end -->



        <!-- cards start -->

        <section id="product1" class="section-p1">

            <h2 class="titulo">Lançamentos</h2>
            <div class="pro-container">
                <section class="produto-carrossel embla">
                    <button class="embla__prev"><i class="fa-solid fa-arrow-left fa-2x"></i></button>
            
                    <div class="embla__viewport">
                        <div class="embla__container">
                            @for ($i = 0; $i < 5; $i++)
                            <div class="pro item">
                                <img src="{{ asset('images/mou_4.jpg') }}" alt="">
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
                        </div>
                    </div>
                    <button class="embla__next"><i class="fa-solid fa-arrow-right fa-2x"></i></button>
                </section>
            </div>
        </section>

        <!-- cards end -->

        <!-- categories start -->

        <div class="categories-container">

            <h2 class="heading">Categorias</h2>

            <div class="categorie-container">

                <a href="#" class="effects">
                    <div class="box">
                        <img src="{{ asset('images/icons/monitor.svg') }}" alt="">
                        <h2 class="itens">Monitor</h2>
                    </div>
                </a>

                <a href="#" class="effects">
                    <div class="box">
                        <img src="{{ asset('images/icons/mouse.svg') }}" alt="">
                        <h2 class="itens">Mouse</h2>
                    </div>
                </a>

                <a href="#" class="effects">
                    <div class="box">
                        <img src="{{ asset('images/transferir.png') }}" alt="">
                        <h2 class="itens">Headset</h2>
                    </div>
                </a>

                <a href="#" class="effects">
                    <div class="box">
                        <img style="color: #000;" src="{{ asset('images/icons/teclado.svg') }}" alt="">
                        <h2 class="itens">Teclado</h2>
                    </div>
                </a>
            </div>

        </div>
    </main>

    <!-- categories end -->

@endsection
