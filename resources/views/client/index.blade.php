@extends('layouts.client')
@section('css', 'home/homepage')
@section('title')@parent Homepage @stop

@section('content')

    <!-- carousel starts  -->

    <section class="home" id="home">



    </section>

    <!-- carousel ends -->

    <!-- services starts -->

    <main>


        <section class="service">
            <div class="container-services">

                <ul class="service-list">

                    <li class="service-item">
                        <div class="service-item-icon">
                            <img src="{{ asset('images/service-icon-1.svg') }}" alt="Service icon">

                        </div>

                        <div class="service-content">
                            <p class="service-item-title">Entrega Gratuita</p>

                            <p class="service-item-text">Em pedidos acima de $900</p>
                        </div>
                    </li>

                    <li class="service-item">
                        <div class="service-item-icon">
                            <img src="{{ asset('images/service-icon-2.svg') }}" alt="Service icon">
                        </div>

                        <div class="service-content">
                            <p class="service-item-title">Aceitamos Devoluções</p>

                            <p class="service-item-text">Política de Devolução de 30 Dias</p>
                        </div>
                    </li>

                    <li class="service-item">
                        <div class="service-item-icon">
                            <img src="{{ asset('images/service-icon-3.svg') }}" alt="Service icon">
                        </div>

                        <div class="service-content">
                            <p class="service-item-title">Segurança de Pagamento</p>

                            <p class="service-item-text">100% Segurança Garantida</p>
                        </div>
                    </li>

                    <li class="service-item">
                        <div class="service-item-icon">
                            <img src="{{ asset('images/service-icon-4.svg') }}" alt="Service icon">
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
                    <a href="#" class="btn-ad">visualizar oferta</a>
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
            </div>
        </section>

        <!-- cards end -->

        <!-- categories start -->

        <div class="categories-container">

            <h2 class="heading">Categorias</h2>

            <div class="categorie-container">

                <a href="#" class="effects">
                    <div class="box">
                        <img src="{{ asset('images/3474360.png') }}" alt="">
                        <h2 class="itens">Monitor</h2>
                    </div>
                </a>

                <a href="#" class="effects">
                    <div class="box">
                        <img src="{{ asset('images/3355050.png') }}" alt="">
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
                        <img src="img/114683.png" alt="">
                        <img src="{{ asset('images/114683.png') }}" alt="">
                        <h2 class="itens">Teclado</h2>
                    </div>
                </a>
            </div>

        </div>
    </main>


    <!-- categories end -->

@endsection
