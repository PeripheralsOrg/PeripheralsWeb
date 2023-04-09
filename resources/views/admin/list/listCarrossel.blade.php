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
        @if (isset($banners))

            @foreach ($banners as $item)
                <section class="info-carrossel">
                    <div class="box-info">
                        <div class="info-img">
                            <p>a</p>
                        </div>
                        
                        <div class="info-items">
                            <h2>{{ $item['nome_banner'] }}</h2>
                            <span>{{ $item['link_carrossel'] }}</span>
                            <p>Peso</p>
                        </div>

                        <div class="box-options">
                            <form action="{{ route('delete-banner', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="fa-solid fa-trash"></i>
                            </form>
                            <form action="{{ route('get-banner', $item['id']) }}" method="GET">
                                @csrf
                                <button type="submit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </form>
                        </div>
                    </div>
            @endforeach
        @endif

        <button id="btnNewProduto" onclick="window.location.href=`{{ route('page-inserirBanner') }}`">
            <div class="icon-container">
                <i class="fa-regular fa-plus"></i>
            </div>
            Novo Banner
        </button>
        </section>
    </main>
@endsection
