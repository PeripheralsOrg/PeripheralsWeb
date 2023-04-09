@extends('layouts.admin')
@section('css', 'admin/listCarrossel')
@section('title')@parent Carrosseis @stop

@section('content')
    <main class="container-carrossel">
        <h1>Carrossel</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="box-carrossel">
            <img src="{{ asset('images/banner.jpeg') }}" alt="">
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

            <button id="btnNewProduto" onclick="window.location.href=`{{ route('page-inserirBanner') }}`">
                <div class="icon-container">
                    <i class="fa-regular fa-plus"></i>
                </div>
                Nova Imagem
            </button>
        </section>
    </main>
@endsection
