@extends('layouts.client')
@section('css', 'home/homepage')
@section('js', 'home/homepage')
@section('title')@parent Página Inicial @stop

{{-- Carrossel CDN --}}

@section('content')

    <!-- Swiper_start -->
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach ($getBanners as $item)
                <div class="swiper-slide">
                    <div class="project-img">
                        <img src="{{ $item['link_carrossel'] }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Swiper-wrapper_end -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- Swiper_end -->

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

            <!-- pro-container_swiper_start -->
            <div class="pro-container">

                <!-- slider_swiper-wrapper_start -->
                <div class="swiper-button-next-produto swiper-navBtn"><i class="fa-solid fa-angle-left"></i></div>

                <div class=" slider swiper-wrapper">


                    @foreach ($getProdutos1 as $item)
                        <div class="pro item swiper-slide"
                            onclick="window.location.href=`{{ route('produto-get', $item['id_produtos']) }}`">
                            <img src="{{ $item['link_img'] }}" alt="{{ $item['nome'] }}">
                            <hr>
                            <div class="des">
                                <span>{{ $item['marca'] }}</span>
                                <h5>{{ $item['nome'] }}</h5>
                                <div class="star">
                                    @for ($i = 0; $i < App\Http\Controllers\ClientProdutoController::getAvaliacaoCarrossel($item['id_produtos']); $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
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
                <!-- slider_swiper-wrapper_end -->

                <div class="swiper-button-prev-produto swiper-navBtn"><i class="fa-solid fa-angle-right"></i></div>

            </div>
            <!-- pro-container_swiper_end -->
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

            <!-- pro-container_swiper_start -->
            <div class="pro-container">

                <!-- slider_swiper-wrapper_start -->
                <div class="swiper-button-next-produto swiper-navBtn"><i class="fa-solid fa-angle-left"></i></div>

                <div class=" slider swiper-wrapper">


                    @foreach ($getProdutos2 as $item)
                        <div class="pro item swiper-slide"
                            onclick="window.location.href=`{{ route('produto-get', $item['id_produtos']) }}`">
                            <img src="{{ $item['link_img'] }}" alt="{{ $item['nome'] }}">
                            <hr>
                            <div class="des">
                                <span>{{ $item['marca'] }}</span>
                                <h5>{{ $item['nome'] }}</h5>
                                <div class="star">
                                    @for ($i = 0; $i < App\Http\Controllers\ClientProdutoController::getAvaliacaoCarrossel($item['id_produtos']); $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
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
                <!-- slider_swiper-wrapper_end -->

                <div class="swiper-button-prev-produto swiper-navBtn"><i class="fa-solid fa-angle-right"></i></div>

            </div>
            <!-- pro-container_swiper_end -->
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
            <h2 class="titulo">Teclados</h2>

            <!-- pro-container_swiper_start -->
            <div class="pro-container">

                <!-- slider_swiper-wrapper_start -->
                <div class="swiper-button-next-produto swiper-navBtn"><i class="fa-solid fa-angle-left"></i></div>

                <div class=" slider swiper-wrapper">


                    @foreach ($getProdutosCategoria as $item)
                        <div class="pro item swiper-slide"
                            onclick="window.location.href=`{{ route('produto-get', $item['id_produtos']) }}`">
                            <img src="{{ $item['link_img'] }}" alt="{{ $item['nome'] }}">
                            <hr>
                            <div class="des">
                                <span>{{ $item['marca'] }}</span>
                                <h5>{{ $item['nome'] }}</h5>
                                <div class="star">
                                    @for ($i = 0; $i < App\Http\Controllers\ClientProdutoController::getAvaliacaoCarrossel($item['id_produtos']); $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
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
                <!-- slider_swiper-wrapper_end -->

                <div class="swiper-button-prev-produto swiper-navBtn"><i class="fa-solid fa-angle-right"></i></div>

            </div>
            <!-- pro-container_swiper_end -->
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
