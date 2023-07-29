@extends('layouts.client')
@section('css', 'home/my-info')
@section('js', 'home/my-info')
@section('title')@parent Minha Conta @stop


@section('content')
    <div class="container">
        <div class="top-infos-user">
            <h2 class="name-user">{{ $getUserInfo['name'] }} {{ $getUserInfo['last_name'] }}</h2>
            <h4 class="email-user">{{ $getUserInfo['email'] }}</h4>
        </div>

        <div class="total-menu-perfil">
            <div class="buttons-choose">
                <button class="button-perfil active" id="button-perfil">Feed</button>
                <button class="button-pedidos" id="button-pedidos">Pedidos</button>
                <button class="button-conta" id="button-conta">Conta</button>
            </div>

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

            <div class="container-buttons">
                <!-- CUPONS -->
                <div class="infos-perfil" id="box-infos-perfil">
                    <div class="wrapper-cupom">
                        <div class="project-cupom">
                            <div class="shop-cupom">
                                <h2 class="definition-product">Seus cupons</h2>
                                @foreach ($getCupom as $item)
                                    @php
                                        $date = Carbon\Carbon::parse($item['data_expiracao']);
                                        $now = Carbon\Carbon::now();
                                        $diff = $date->diffInDays($now);
                                    @endphp

                                    <div class="box-order-cupom">
                                        <div class="content-cupom">
                                            <p class="offer-cupom">{{ $item['nome'] }}</p>
                                            <p class="product-title-cupom">{{ $diff }} dias úteis para utilizar o
                                                cupom</p>
                                            <p class="cupom">Use Cupom Code: <span
                                                    class="code-cupom">{{ $item['codigo'] }}</span></p>
                                            <p class="data-cupom">Válido até:
                                                {{ Carbon\Carbon::parse($item['data_expiracao'])->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>



                <!-- PEDIDOS -->
                <div class="infos-pedidos hidden" id="box-infos-pedidos">
                    <div class="wrapper">
                        <div class="project">
                            <div class="shop">
                                @foreach ($getPedidos as $item)
                                <h2 class="definition-product">{{$getStatusVenda[$item['id_venda_status']]['status_venda']}}</h2>
                                    <div class="box-order">
                                        <div class="content">
                                            <p class="marca">
                                                {{ Carbon\Carbon::parse($item['created_at'])->format('d/m/Y h:i:s') }}</p>
                                            <p class="product-title">{{ $item['quantidade_items'] }} Itens Comprados</p>
                                            <p class="valor">R$ {{ $item['valor_total'] }}</p>
                                            <p class="valor">R$ {{ $item['frete'] }}</p>
                                            <p class="unit"><a
                                                    href="{{ route('pedido-detailsCliente', $item['id_venda']) }}">Ver
                                                    detalhes</a></p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>



                <!-- CONTA -->
                <div class="infos-conta hidden" id="box-infos-conta">
                    <div class="count-wrapper">
                        <div class="system-count">
                            <div class="count-content">
                                <div class="panel">
                                    <h2 class="count-title">Visão Geral da Conta</h2>
                                </div>
                                <div class="list">
                                    <ul>
                                        <li id="liInfo" class="marked-info">
                                            <span>Dados Pessoais</span>
                                            <i class="fa fa-angle-right"></i>
                                        </li>

                                        <li id="liInfo"
                                            onclick="window.location.href='{{ route('list-meusEnderecos') }}'">
                                            <span>Lista de Endereços</span>
                                            <i class="fa fa-angle-right"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="perfil-content">
                            <section id="testimonials">
                                <div class="testimonial-box-container">
                                    <div class="testimonial-box">
                                        <div class="box-top">
                                            <div class="profile">
                                                <div class="name-data">
                                                    <p id="strongText">MINHAS INFORMAÇÕES</p>
                                                    <span>Por favor, confira os detalhes abaixo para garantir que estão
                                                        atualizados.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="client-comment">
                                            <div class="name-data">
                                                <p id="strongText">DETALHES</p>
                                            </div>
                                            <p class="information">{{ $getUserInfo['name'] }}</p>
                                            <p class="information">{{ $getUserInfo['last_name'] }}</p>
                                            <p class="information">
                                                Telefone Celular:
                                                {{ $getUserInfo['telefone_celular'] ? $getUserInfo['telefone_celular'] : '-' }}
                                            </p>
                                            <p class="information">Receber Informações:
                                                {{ $getUserInfo['feedback'] ? 'Sim' : 'Não' }}
                                            </p>
                                            <div class="container-linkEdit">
                                                <a class="information-link"
                                                    href="{{ route('page-infoEdit', 'common') }}">EDITAR</a>
                                            </div>
                                        </div>

                                        <div class="client-comment">
                                            <div class="name-data">
                                                <p id="strongText">DETALHES DE LOGIN</p>
                                            </div>
                                            <p class="information">{{ $getUserInfo['email'] }}</p>
                                            {{-- <p class="information">Email Verificado:
                                                {{ $getUserInfo['email_verified_at'] ? 'Sim' : 'Não' }}</p> --}}
                                            {{-- @if (!$getUserInfo['email_verified_at'])
                                                <a href="" id="verifyEmail">Verificar Email</a>
                                            @endif --}}
                                            <div class="container-linkEdit">
                                                <a class="information-link"
                                                    href="{{ route('page-infoEdit', 'email') }}">EDITAR</a>
                                            </div>
                                        </div>

                                        <div class="btn-container">
                                            <a href="{{ route('logout-user') }}" class="btn-desconnect">Desconectar</a>
                                        </div>

                                    </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
