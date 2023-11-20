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
                        @for ($i = 0; $i < round($avaliacaoMedia); $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @if (is_float($avaliacaoMedia) && round($avaliacaoMedia) < $avaliacaoMedia)
                            <i class="fas fa-star-half-alt"></i>
                        @endif
                        <span>{{ $avaliacaoMedia }} ({{ $avaliacaoCount }})</span>
                    </div>

                    <div class="product-price">
                        @if ($item['is_promocao'] == 1)
                            <p class="last-price">Preço antigo: <span>R$ 257,00</span></p>
                        @endif

                        <p class="new-price" style="color: var(--vermelho);">{{ (NumberFormatter::create('en',  NumberFormatter::CURRENCY))->formatCurrency($item['preco'], 'Dolar')}}</p>
                        <p class="parcellate">Em 12x de R$ {{ round(($item['preco'] / 12), 2) }}</p>
                        {{-- <div class="calculate">
                            <p>Calcular frete de entrega</p>
                            <div class="box-cepEntrega">
                                <i class="fas fa-truck-moving"></i>
                                <input maxlength="10" class="cep" id="inputCalculaCep" data-js="cep" type="text" placeholder="Digite seu CEP">
                                <input type="hidden" name="valueFrete" id="valueFreteInput" value="{{ csrf_token() }}">
                                <button type="button" class="btn-consultar button-cep-calc"> Consultar </button>
                            </div>
                        </div> --}}
                    </div> 

                    <form class="product-detail" action="{{ route('carrinho-insert', $item['id_produtos']) }}"
                        method="GET">
                        <h2>Detalhes: </h2>
                        <p class="desc-prod">{{ $item['descricao'] }}</p>
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
                            <button type="submit" class="btn-check" id="btnCarrinho"> Adicionar ao carrinho
                            </button>
                            <button type="submit" class="btn-check" id="btnCompra">
                                Compre agora
                            </button>
                        </div>
                        <!--Exibir informações de prazo e valor-->
                        <div id="cep-info-sedex">
                            <p id="valueSedex"></p>
                            <p id="prazoSedex"></p>
                        </div>

                        <div id="cep-info-pac">
                            <p id="valuePac"></p>
                            <p id="prazoPac"></p>
                            <br>
                            <p id="textObs"></p>
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
                @foreach ($getProdutos1 as $produto)
                    <div class="pro item swiper-slide"
                        onclick="window.location.href=`{{ route('produto-get', $produto['id_produtos']) }}`">
                        <img src="{{ $produto['link_img'] }}" alt="{{ $produto['nome'] }}">
                        <hr>
                        <div class="des">
                            <span>{{ $produto['marca'] }}</span>
                            <h5>{{ $produto['nome'] }}</h5>
                            <div class="star-rating">
                                @for ($i = 0; $i < App\Http\Controllers\ClientProdutoController::getAvaliacaoCarrossel($produto['id_produtos']); $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <h4>R$ {{ $produto['preco'] }}</h4>
                        </div>
                        <div class="actions-container">
                            <a href="{{ route('carrinho-insert', $produto['id_produtos']) }}"><i
                                    class="fa fa-shopping-bag"></i></a>

                            <a href="{{ route('favoritar-produto', $produto['id_produtos']) }}"><i
                                    class="fa fa-heart"></i></a>
                        </div>
                    </div>
                @endforeach

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
                @foreach ($getProdutos2 as $produto)
                    <div class="pro item swiper-slide"
                        onclick="window.location.href=`{{ route('produto-get', $produto['id_produtos']) }}`">
                        <img src="{{ $produto['link_img'] }}" alt="{{ $produto['nome'] }}">
                        <hr>
                        <div class="des">
                            <span>{{ $produto['marca'] }}</span>
                            <h5>{{ $produto['nome'] }}</h5>
                            <div class="star-rating">
                                @for ($i = 0; $i < App\Http\Controllers\ClientProdutoController::getAvaliacaoCarrossel($produto['id_produtos']); $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <h4>R$ {{ $produto['preco'] }}</h4>
                        </div>
                        <div class="actions-container">
                            <a href="{{ route('carrinho-insert', $produto['id_produtos']) }}"><i
                                    class="fa fa-shopping-bag"></i></a>

                            <a href="{{ route('favoritar-produto', $produto['id_produtos']) }}"><i
                                    class="fa fa-heart"></i></a>
                        </div>
                    </div>
                @endforeach

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
                        <p class="avaliantion">{{ $avaliacaoMedia }}</p>
                    </div>
                    <div class="box">
                        <div class="product-rating">
                            @for ($i = 0; $i < round($avaliacaoMedia); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @if (is_float($avaliacaoMedia) && round($avaliacaoMedia) < $avaliacaoMedia)
                                <i class="fas fa-star-half-alt"></i>
                            @endif
                        </div>
                        <div>
                            <p class="avaliating">{{ $avaliacaoCount }} avaliações</p>
                        </div>
                    </div>
                </div>
                <div class="panel_progress">
                    <div class="progress-bar">
                        <div class="progress" style="width: {{ $avaliacaoPercent[5] }}%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">5</span>
                    </div>

                    <div class="progress-bar">
                        <div class="progress" style="width: {{ $avaliacaoPercent[4] }}%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">4</span>
                    </div>


                    <div class="progress-bar">
                        <div class="progress" style="width: {{ $avaliacaoPercent[3] }}%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">3</span>
                    </div>


                    <div class="progress-bar">
                        <div class="progress" style="width: {{ $avaliacaoPercent[2] }}%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">2</span>
                    </div>


                    <div class="progress-bar">
                        <div class="progress" style="width: {{ $avaliacaoPercent[1] }}%"></div>
                    </div>
                    <div class="rating_pequena">
                        <div class="star"><i class="fas fa-star"></i></div>
                        <span class="note">1</span>
                    </div>

                </div>
            </div>

            <div class="comment-content">
                <section id="testimonials">
                    @foreach ($avaliacaoAll as $item)
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
                                            <p id="emailUserComent">
                                                {{ App\Http\Controllers\ClientProdutoController::getUserAvaliacao($item['id_users']) }}
                                            </p>
                                            <span>{{ Carbon\Carbon::parse($item['created_at'])->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                    <!-- review  -->
                                    <div class="reviews">
                                        @for ($i = 0; $i < $item['avaliacao']; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @if ($item['avaliacao'] < 5)
                                            @for ($i = 0; $i < 5 - $item['avaliacao']; $i++)
                                                <i class="fa-regular fa-star"></i>
                                            @endfor
                                        @endif
                                    </div>
                                </div>

                                <!-- comments -->
                                <div class="client-comment">
                                    <p>{{ $item['comentario'] }}</p>
                                </div>

                                <div class="btn-container">
                                    <div class="btn-box">
                                        <button class="like" onclick="window.location.href='{{route('like-avaliacao', $item['id_comentario'])}}'">
                                            <span class="span-box">
                                                <span class="util">É útil</span>
                                                <span class="like-icon"><i class="fa fa-thumbs-up"
                                                        aria-hidden="true"></i></span>
                                                <span class="qtd-likes">{{ $item['likes'] }}</span>
                                            </span>
                                        </button>
                                        {{-- <button class="deslike">
                                            <span class="span-box">
                                                <span class="like-icon"><i class="fa fa-thumbs-down"
                                                        aria-hidden="true"></i></span>
                                            </span>
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



            </div>
            </section>
        </div>
    </div>
    </div>
@endsection
