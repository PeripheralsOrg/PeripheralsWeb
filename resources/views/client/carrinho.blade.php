@extends('layouts.client')
@section('css', 'home/carrinho')
@section('js', 'home/carrinho')
@section('title')@parent Carrinho de Compras @stop


@section('content')
    <!-- Wrapper_Start -->
    <div class="wrapper">
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
                                    

                                <div class="quant-remove box-info">
                                    <!-- Quantidade -->
                                    <form id="quantForm-{{ $item['id_produto'] }}" class="unit"
                                        action="{{ route('carrinho-update', [$item['id_produto'], $item['id_carrinho']]) }}"
                                        method="GET">
                                        Qtd:
                                        <select id="selectQuant" onchange="submitQuant(this, {{ $item['id_produto'] }})">
                                            @for ($j = 1; $j < $inventario; $j++)
                                                @if ($j <= 30)
                                                    @if ($item['quantidade'] === $j)
                                                        <option selected value="{{ $j }}">
                                                            {{ $j }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $j }}">{{ $j }}
                                                        </option>
                                                    @endif
                                                @endif
                                            @endfor
                                        </select>
                                        <input type="hidden" name="quantidade" id="quantInput-{{ $item['id_produto'] }}">
                                    </form>

                                    <!-- Remover -->
                                    <a id="removeItem"
                                        href="{{ route('carrinho-delete', [$item['id_produto'], $item['id_carrinho']]) }}">Remove</a>
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
                <p><span class="title_order">Finalizar Compra</span></p>

                <p><span>Cupom</span></p>
                @foreach ($carrinho as $item)
                    <form class="container" action="{{ route('carrinho-cupom', $item['id_carrinho']) }}">
                        <input type="text" name="cupom" class="text_input" placeholder="Cupom" />
                        <button type="submit" value="Save" class="btn">CLICK</button>
                    </form>

                    <p><span>Frete</span> <span>R$ 00,00</span></p>
                    <p><span>Cupom</span> <span>R$ 00,00</span></p>
                    <p><span>Subtotal</span> <span>R$ {{ $item['valor_total'] }}</span></p>
                    <hr>
                    <p><span>Total</span> <span>R$ {{ $item['valor_total'] }}</span></p>
                    <a href="#">Finalizar</a>
                @endforeach

            </div>
        @endif
        <!-- Right_end -->
    </div>
    <!-- Project_end -->
    </div>
    <!-- Wrapper_end -->
@endsection
