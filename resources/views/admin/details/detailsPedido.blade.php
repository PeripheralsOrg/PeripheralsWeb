@extends('layouts.admin')
@section('css', 'admin/detailsPedido')

@section('content')

    <section class="container-endereco">
        <h1 id="titlePage">Detalhes do Pedido N◦ {{ array_values($getVenda)[0]['id_venda'] }}</h1>
        @section('title')@parent Detalhes do Pedido N◦ {{ array_values($getVenda)[0]['id_venda'] }} @stop


        @if (count($getUser) > 0)
            @foreach ($getUser as $item)
                <div class="box-endereco">
                    <h2 id="dadosEntrega">Dados do Usuário</h2>
                    <div class="box-rowValues">
                        <div class="row-value">
                            <h3 id="pDestaque">Nome:</h3>
                            <h3>{{ $item['name'] }}</h3>
                        </div>

                        <div class="row-value">
                            <h3 id="pDestaque">Último Nome:</h3>
                            <h3>{{ $item['last_name'] }}</h3>
                        </div>
                    </div>

                    <div class="box-rowValues">
                        <div class="row-value">
                            <h3 id="pDestaque">Email:</h3>
                            <h3>{{ $item['email'] }}</h3>
                        </div>

                        <div class="row-value">
                            <h3 id="pDestaque">Telefone:</h3>
                            <h3>{{ $item['telefone_celular'] }}</h3>
                        </div>
                    </div>
                    <div class="box-rowValues">
                        <div class="row-value">
                            <h3 id="pDestaque">CPF:</h3>
                            <h3>{{ $item['cpf'] }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p id="errorEndereco">Nenhum endereço cadastrado!</p>
        @endif
    </section>


    <section class="container-endereco">
        <h1 id="titlePage">Endereço utilizado</h1>

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
                                    <p class="sub">Quantidade: {{ $item['quantidade'] }}</p>
                                    <!-- Subtotal -->
                                    <p class="sub">Subtotal: R$ {{ $item['valor_total'] }}</p>
                                </div>

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
                    <p><span>Frete</span> <span>R$ {{ array_values($getVenda)[0]['frete'] }}</span></p>
                    <p><span>Cupom</span> <span>R$ 00,00</span></p>
                    <p><span>Quantidade Total</span> <span>{{ array_values($getVenda)[0]['quantidade_items'] }} Itens</span></p>
                    <p><span>Subtotal</span> <span>R$ {{ $item['valor_total'] }}</span></p>
                    <hr>
                    <p><span>Total</span> <span>R$
                            {{ floatval($item['valor_total']) + floatval(array_values($getVenda)[0]['frete']) }}</span></p>
                    <button id="endCompra"
                        onclick="window.location.href='{{route('page-listPedidos')}}'">Voltar</button>
                @endforeach

            </div>
        @endif
        <!-- Right_end -->
    </section>

    <section class="updateInfo">
        <form action="{{ route('update-statusPedido') }}">
            <label for="">Atualizar Status do pedido</label>
            @foreach ($getVendaStatus as $item)
                <select name="status-pedido">
                    <option value="{{ $item['id_status'] }}">{{ $item['status_venda'] }}</option>
                </select>
            @endforeach
            <input type="hidden" name="idVenda" value="{{ array_values($getVenda)[0]['id_venda'] }}">
            <button>Atualizar</button>
        </form>
    </section>

@endsection
