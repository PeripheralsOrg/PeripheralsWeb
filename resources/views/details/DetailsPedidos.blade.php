@extends('layouts.admin')
@section('css', 'admin/listCarrossel')
@section('title')@parent Pedido N° 56631 @stop

@section('content')
    <main class="container-carrossel">
        <h1>Pedidos</h1>

        <section class="box-carrossel">
            <img src="{{asset('images/banner.jpeg')}}" alt="">
        </section>

        <section class="info-carrossel">
            <div class="box-info">
                <div class="info-img">
                    <p>a</p>
                </div>
                <div class="info-items">
                    <h2>Nome Carrossel</h2>
                    <span>Caminho</span>
                    <p>Peso</p>
                </div>
            </div>

            <button id="btnNewProduto">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Nova Imagem
            </button>
        </section>
    </main>
@endsection
