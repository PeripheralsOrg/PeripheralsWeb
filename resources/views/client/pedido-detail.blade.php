@extends('layouts.client')
@section('css', 'home/finalizar-pagamento')

@section('content')
    <section class="container-endereco">
        <h1 id="titlePage">Detalhes do Pedido N◦ {{ $getVenda[0]['id_venda'] }}</h1>
        @section('title')@parent Detalhes do Pedido N◦ {{ $getVenda[0]['id_venda'] }} @stop

        @if (count($getEndereco) > 0)
            @foreach ($getEndereco as $item)
                <div class="box-endereco">
                    <h2 id="dadosEntrega">Dados de entrega</h2>
                    <div class="box-rowValues">
                        <div class="row-value">
                            <h3 id="pDestaque">Logradouro:</h3>
                            <h3>{{ $item['logradouro'] }}</h3>
                        </div>

                        <div class="row-value">
                            <h3 id="pDestaque">Bairro:</h3>
                            <h3>{{ $item['bairro'] }}</h3>
                        </div>
                    </div>

                    <div class="box-rowValues">
                        <div class="row-value">
                            <h3 id="pDestaque">Tipo de Logradouro:</h3>
                            <h3>{{ $item['tipo_logradouro'] }}</h3>
                        </div>

                        <div class="row-value">
                            <h3 id="pDestaque">Número:</h3>
                            <h3>{{ $item['numero'] }}</h3>
                        </div>
                    </div>

                    <div class="box-rowValues">
                        <div class="row-value">
                            <h3 id="pDestaque">Estado:</h3>
                            <h3>{{ $item['estado'] }}</h3>
                        </div>

                        <div class="row-value">
                            <h3 id="pDestaque">Cidade:</h3>
                            <h3>{{ $item['cidade'] }}</h3>
                        </div>
                    </div>

                    <div class="box-rowValues">
                        @if (!empty($item['complemento']))
                            <div class="row-value">
                                <h3 id="pDestaque">Complemento:</h3>
                                <h3>{{ $item['complemento'] }}</h3>
                            </div>
                        @endif

                        <div class="row-value">
                            <h3 id="pDestaque">Ponto de Referência:</h3>
                            <h3>{{ $item['ponto_ref'] }}</h3>
                        </div>
                    </div>

                    <div class="box-rowValues">
                        <div class="row-value">
                            <h3 id="pDestaque">CEP:</h3>
                            <h3>{{ $item['cep'] }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p id="errorEndereco">Nenhum endereço cadastrado!</p>
        @endif
    </section>

    <section class="wrapper">
        <h1 id="titleCarrinho">Itens Comprados</h1>
        <!-- Project_Start -->
        <div class="project">
            <!-- Shop_start -->
            @if (!empty($carrinho) || !empty($carrinhoItens))

                <div class="shop">
                    <!-- Box_start -->
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
                    @php $i = 0; @endphp
                    @foreach ($carrinhoItens as $item)
                        @php $i++; @endphp
                        <div class="box">
                            <img src="{{ $arrayImages[$i - 1] }}">
                            <div class="content">
                                <div class="info-prod box-info">
                                    <!-- Nome do Produto -->
                                    <h3 id="nomeProd">{{ $listProdutos[$i - 1]['nome'] }}</h3>
                                    <!-- Marca -->
                                    @foreach ($marca as $itemMarca)
                                        <h4 id="marcaProd">{{ $itemMarca['nome'] }}</h4>
                                    @endforeach
                                    <!-- Valor -->
                                    <h4 class="valor">R$ {{ $listProdutos[$i - 1]['preco'] }}</h4>
                                    <!-- Subtotal -->
                                    <p class="sub">Subtotal: R$ {{ $item['valor_total'] }}</p>
                                </div>
                                <a id="feedbackLink" href="{{ route('feedback-produto', $item['id_produto']) }}">Avaliar
                                    Produto</a>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="box-errorVazio">
                        <h1>{{ $erro }}</h1>
                    </div>
            @endif


            <!-- Box_end -->
        </div>
        <!-- Shop_end -->
        @if (!empty($carrinho) || !empty($carrinhoItens))
            <!-- Right-bar -->
            <div class="right-bar">
                @foreach ($carrinho as $item)
                    <p><span>Frete</span> <span>R$ {{ $getVenda[0]['frete'] }}</span></p>
                    <p><span>Cupom</span> <span>R$ {{ $getVenda[0]['valor_desconto_total'] }}</span></p>
                    <p><span>Subtotal</span> <span>R$ {{ $item['valor_total'] }}</span></p>
                    <hr>
                    <p><span>Total</span> <span>R$
                            {{ $getVenda[0]['valor_total'] }}</span></p>
                    <button id="endCompra" onclick="window.location.href='{{ route('client-info') }}'">Voltar</button>
                @endforeach

            </div>
        @endif
        <!-- Right_end -->
    </section>

@endsection
