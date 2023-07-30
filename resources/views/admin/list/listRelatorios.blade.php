@extends('layouts.admin')
@section('css', 'admin/listUserAdm')
@section('title')@parent Usuários Administrativos @stop

@section('content')

    <!-- Titulo -->
    <main class="container-relatorios">
        <h1>Relatórios</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="box-chart">
            <h2>{{ $chartVenda->options['chart_title'] }}</h2>
            {!! $chartVenda->renderHtml() !!}
        </div>
        <div class="box-chart">
            <h2>{{ $chartVenda2->options['chart_title'] }}</h2>
            {!! $chartVenda2->renderHtml() !!}
        </div>

        <div class="box-chart">
            <h2>{{ $chartUsers->options['chart_title'] }}</h2>
            {!! $chartUsers->renderHtml() !!}
        </div>

        <div class="box-chart">
            <h2>{{ $chartProduto->options['chart_title'] }}</h2>
            {!! $chartProduto->renderHtml() !!}
        </div>

        <div class="box-chart">
            <h2>{{ $chartProdutoQuant->options['chart_title'] }}</h2>
            {!! $chartProdutoQuant->renderHtml() !!}
        </div>



        {!! $chartVenda->renderChartJsLibrary() !!}
        {!! $chartVenda->renderJs() !!}
        {!! $chartVenda2->renderJs() !!}
        {!! $chartUsers->renderJs() !!}
        {!! $chartProduto->renderJs() !!}
        {!! $chartProdutoQuant->renderJs() !!}



    </main>

@endsection
