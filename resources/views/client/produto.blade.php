@extends('layouts.client')
@section('css', 'home/produto')
@section('js', 'home/produto')
@section('title')@parent Item Pesquisado @stop

@section('content')

    <div class="card-wrapper">

        @foreach ($produtos as $item)
            <div class="card">
                <!-- card left -->
                <div class="product-imgs">
                    <div class="img-display">
                        <div class="img-showcase">
                            @foreach ($imgProdutos as $itemImg)
                                <img src="{{ $itemImg['link_img'] }}" alt="shoe image">
                            @endforeach
                        </div>
                    </div>

                    {{-- NÃO APAGUE --}}
                    @php
                        $i = 0;
                    @endphp
                    <div class="img-select">
                        @foreach ($imgProdutos as $itemImg)
                            @php
                                $i++;
                            @endphp
                            <div class="img-item">
                                <a href="#" data-id="{{ $i }}">
                                    <img src="{{ $itemImg['link_img'] }}" alt="shoe image">
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>


                <!-- card right -->
                <div class="product-content">
                    <div class="row-favorito">
                        <h2 class="product-title">{{ $item['nome'] }}</h2>
                        <a href="{{ route('favoritar-produto', $item['id_produtos']) }}">
                            <i class="fa-regular fa-heart"></i>
                        </a>
                    </div>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span>4.7(21)</span>
                    </div>

                    <div class="product-price">
                        @if ($item['is_promocao'] == 1)
                            <p class="last-price"><span>R$257,00</span></p>
                        @endif

                        <p class="new-price"><span>R$ {{ $item['preco'] }}</span></p>
                        <p class="parcellate"><span>em 12x de R$ {{ round($item['preco'] / 12) }}</span></p>
                        <div class="calculate">
                            <p>Calcular frete de entrega</p>
                            <div class="box-cepEntrega">
                                <i class="fas fa-truck-moving"></i>
                                <input class="cep" type="text" placeholder="Digite seu CEP">
                                <button type="button" class="btn-consultar"> Consultar </button>
                            </div>
                        </div>
                    </div>

                    <form class="product-detail" action="{{route('carrinho-insert', $item['id_produtos'])}}" method="GET">
                        <h2>Detalhes: </h2>
                        <p>{{ $item['descricao'] }}</p>
                        <div class="row-specialInfo">
                            @foreach ($marcas as $itemMarcas)
                                <p><span class="special-info">Marca:</span> {{ $itemMarcas['nome'] }}</p>
                            @endforeach
                            @foreach ($categorias as $itemCategoria)
                                <p><span class="special-info">Categoria:</span> {{ $itemCategoria['categoria'] }}</p>
                            @endforeach
                        </div>
                        <a href="#fichaTecnica" id="linkInfo">Veja mais informações</a>
                        @foreach ($detalhesProduto as $itemDetalhe)
                            <ul>
                                <li>Cor: <span>{{ $itemDetalhe['cor'] }}</span></li>
                                <li>Tamanho: <span>{{ $itemDetalhe['tamanho'] }}</span></li>
                                <li>Peso: <span>{{ $itemDetalhe['peso'] }}</span></li>
                                <li>Shipping : <span>Gratuita</span></li>
                            </ul>
                        @endforeach
                        <select name="quantidade" id="selectQuant">
                            @for ($j = 1; $j < array_values($quantProduto)[0]['quantidade']; $j++)
                                @if ($j <= 30)
                                    <option value="{{ $j }}">{{ $j }}</option>
                                @endif
                            @endfor
                        </select>
                        <div class="purchase-info">
                            <button type="submit" type="button" class="btn-check" id="btnCarrinho"> Adicionar ao carrinho </button>
                            <button type="button" onclick="console.log('asdasda')" class="btn-check" id="btnCompra"> Compre agora </button>
                        </div>
                    </form>

                </div>
            </div>
        @endforeach

    </div>

    <!-- section-p1_start -->
    <h2 class="titulo">Lançamentos</h2>
    <section id="product1" class="section-p1">

        <!-- pro-container_swiper_start -->
        <div class="pro-container swiper">

            <!-- slider_swiper-wrapper_start -->
            <div class=" slider swiper-wrapper">
                <!-- pro_item_swiper-slide_start -->
                @for ($i = 0; $i < 6; $i++)
                    <div class="pro item swiper-slide">
                        <img src="{{ asset('images/mou_4.jpg') }}" alt="">
                        <hr>
                        <div class="des">
                            <span>MULTILASER</span>
                            <h5>Mouse Gamer</h5>
                            <div class="star-rating">
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

                <!-- pro_item_swiper-slide_end -->

            </div>
            <!-- slider_swiper-wrapper_end -->

            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>

        </div>
        <!-- pro-container_swiper_end -->

        </div>

    </section>
    <!-- section-p1_end -->

    <!-- section-p1_start -->
    <h2 class="titulo">Lançamentos</h2>

    <section id="product1" class="section-p1">

        <!-- pro-container_swiper_start -->
        <div class="pro-container swiper">

            <!-- slider_swiper-wrapper_start -->
            <div class=" slider swiper-wrapper">
                <!-- pro_item_swiper-slide_start -->
                @for ($i = 0; $i < 6; $i++)
                    <div class="pro item swiper-slide">
                        <img src="{{ asset('images/mou_4.jpg') }}" alt="">
                        <hr>
                        <div class="des">
                            <span>MULTILASER</span>
                            <h5>Mouse Gamer</h5>
                            <div class="star-rating">
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

                <!-- pro_item_swiper-slide_end -->

            </div>
            <!-- slider_swiper-wrapper_end -->

            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>

        </div>
        <!-- pro-container_swiper_end -->

        </div>

    </section>
    <!-- section-p1_end -->

    <div class="ficha_tecnica" id="fichaTecnica">
        <h2 class="title_especific">Especificações</h2>
        <table>

            <tbody>

                @foreach ($detalhesProduto as $itemDetalhes)
                    @if ($itemDetalhes['codigo'])
                        <tr>
                            <th scope="col">Código</th>
                            <td data-label="Account">{{ $itemDetalhes['codigo'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['fonte_energia'])
                        <tr>
                            <th scope="col">Fonte de Energia</th>
                            <td data-label="Account">{{ $itemDetalhes['fonte_energia'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['tipo_tela'])
                        <tr>
                            <th scope="col">Tipo de Tela</th>
                            <td data-label="Account">{{ $itemDetalhes['tipo_tela'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['tipo_audio'])
                        <tr>
                            <th scope="col">Tipo de Áudio</th>
                            <td data-label="Account">{{ $itemDetalhes['tipo_audio'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['resolucao'])
                        <tr>
                            <th scope="col">Resolução</th>
                            <td data-label="Account">{{ $itemDetalhes['resolucao'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['tecnologia'])
                        <tr>
                            <th scope="col">Tecnologia</th>
                            <td data-label="Account">{{ $itemDetalhes['tecnologia'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['conexao'])
                        <tr>
                            <th scope="col">Conexão</th>
                            <td data-label="Account">{{ $itemDetalhes['conexao'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['microfone'])
                        <tr>
                            <th scope="col">Microfone</th>
                            <td data-label="Account">{{ $itemDetalhes['microfone'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['frequencia'])
                        <tr>
                            <th scope="col">Frequência</th>
                            <td data-label="Account">{{ $itemDetalhes['frequencia'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['dpi'])
                        <tr>
                            <th scope="col">DPI</th>
                            <td data-label="Account">{{ $itemDetalhes['dpi'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['tipo_teclado'])
                        <tr>
                            <th scope="col">Tipo de Teclado</th>
                            <td data-label="Account">{{ $itemDetalhes['tipo_teclado'] }}</td>
                        </tr>
                    @endif

                    @if ($itemDetalhes['info_adicional'])
                        <tr>
                            <th scope="col">Informações Adicionais</th>
                            <td data-label="Account">{{ $itemDetalhes['info_adicional'] }}</td>
                        </tr>
                    @endif
                    @if ($itemDetalhes['garantia'])
                        <tr>
                            <th scope="col">Garantia</th>
                            <td data-label="Account">{{ $itemDetalhes['garantia'] }}</td>
                        </tr>
                    @endif
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="rating-wrapper">
        <div class="system-rating">
            <div class="rating-content">
                <h2 class="rating-title">Comentarios</h2>

                <div class="panel">
                    <div class="nota">
                        <p class="avaliantion">4.7</p>
                    </div>
                    <div class="box">
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <div>
                            <p class="avaliating">950 avaliações</p>
                        </div>
                    </div>
                </div>
                <div class="panel_progress">
                    <div class="progress-bar">
                        <div class="progress" style="width: 75%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">5</span>
                    </div>

                    <div class="progress-bar">
                        <div class="progress" style="width: 55%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">4</span>
                    </div>


                    <div class="progress-bar">
                        <div class="progress" style="width: 75%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">3</span>
                    </div>


                    <div class="progress-bar">
                        <div class="progress" style="width: 25%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">2</span>
                    </div>


                    <div class="progress-bar">
                        <div class="progress" style="width: 5%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">1</span>
                    </div>

                </div>
            </div>

            <div class="comment-content">
                <section id="testimonials">
                    @for ($i = 0; $i < 6; $i++)
                        <!-- testimonials-box-container -->
                        <div class="testimonial-box-container">
                            <!-- BOX-1 -->
                            <div class="testimonial-box">
                                <!-- top -->
                                <div class="box-top">
                                    <!-- profile -->
                                    <div class="profile">

                                        <!-- name-and-data -->
                                        <div class="name-data">
                                            <p id="emailUserComent">Samuca@gmail.com</p>
                                            <span>10/07/2023</span>
                                        </div>
                                    </div>
                                    <!-- review  -->
                                    <div class="reviews">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>

                                <!-- comments -->
                                <div class="client-comment">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa distinctio nobis
                                        facilis
                                        accusamus maiores assumenda, corrupti nostrum dignissimos neque iste aperiam
                                        obcaecati
                                        est ut corporis odio quaerat laborum consequuntur culpa!</p>
                                </div>

                                <div class="btn-container">
                                    <div class="btn-box">
                                        <button class="like">
                                            <span class="span-box">
                                                <span class="util">É útil</span>
                                                <span class="like-icon"><i class="fa fa-thumbs-up"
                                                        aria-hidden="true"></i></span>
                                                <span class="qtd-likes">200</span>
                                            </span>
                                        </button>
                                        <button class="deslike">
                                            <span class="span-box">
                                                <span class="like-icon"><i class="fa fa-thumbs-down"
                                                        aria-hidden="true"></i></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor



            </div>
            </section>
        </div>
    </div>
    </div>
@endsection
