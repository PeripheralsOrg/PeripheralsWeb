@extends('layouts.admin')
@section('css', 'admin/detailsComentario')


@section('content')

    <main class="main-avaliar">
        <section class="container-produto">
            @foreach ($produto as $item)
                <div class="box-produto">
                    <img src="{{ $item['link_img'] }}">
                    <div class="info-prod">
                        <h2 id="nomeProd">{{ $item['nome'] }}</h2>
                        <h3 id="marcaProd">{{ $item['marca'] }}</h3>
                        <h3 id="marcaProd">{{ $item['modelo'] }}</h3>
                        <h3 class="valor">R$ {{ $item['preco'] }}</h3>
                    </div>
                </div>
            @endforeach

        </section>
        <form class="form-avaliar">
            <h1>Avaliar Produto</h1>


            <div class="box-input">
                <label for="">Titulo</label>
                <input disabled type="text" name="titulo" placeholder="Título" value="{{ $getComment[0]['titulo'] }}">
            </div>

            <p>{{ $getComment[0]['avaliacao'] }} Estrelas</p>

            <textarea disabled name="comentario" id="textAreaComment" cols="30" rows="10" placeholder="Comentário">{{ $getComment[0]['comentario'] }}</textarea>

        </form>
        <button id="feedbacKBtn" onclick="window.location.href='{{ route('page-listComentarios') }}'">Voltar</button>
        <button id="feedbacKBtn"
            onclick="window.location.href='{{ route('page-deleteComentario', $getComment[0]['id_comentario']) }}'">
            Deletar Comentário
        </button>


    </main>
@endsection
