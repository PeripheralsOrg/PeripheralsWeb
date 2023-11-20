@extends('layouts.client')
@section('css', 'home/avaliar-produto')
@section('js', 'valida-forms')
@section('title')@parent Cadastro @stop


@section('content')
    <main class="main-avaliar">
        <section class="container-produto">
            @foreach ($produto as $item)
                <div class="box-produto">
                    <img src="{{ $item['link_img'] }}">
                    <div class="info-prod">
                        <h2 id="nomeProd">{{$item['nome']}}</h2>
                        <h3 id="marcaProd">{{$item['marca']}}</h3>
                        <h3 id="marcaProd">{{$item['modelo']}}</h3>
                        <h3 class="valor">{{(NumberFormatter::create('pt_BR',  NumberFormatter::CURRENCY))->formatCurrency($item['preco'], 'BRL')}}</h3>
                    </div>
                </div>
            @endforeach

        </section>
        <form action="{{ route('avaliar-produto') }}" class="form-avaliar">
            <h1>Avaliar Produto</h1>
            <input type="hidden" name="idProduto" value="{{ $idProduto }}">


            <div class="box-input">
                <label for="">Titulo</label>
                <input type="text" name="titulo" placeholder="Título">
            </div>

            <div class="rate">
                <p>Avaliar</p>
                <div class="input-rateBox">
                    <input type="radio" id="star5" name="avaliacao" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="avaliacao" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="avaliacao" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="avaliacao" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="avaliacao" value="1" />
                    <label for="star1" title="text">1 star</label>
                </div>
            </div>

            <textarea name="comentario" id="textAreaComment" cols="30" rows="10" placeholder="Comentário"></textarea>

            <button id="feedbacKBtn">Avaliar</button>
        </form>
    </main>

@endsection
