@extends('layouts.admin')
@section('css', 'admin/homepage')
@section('title')@parent Gráficos @stop

@section('content')
    <h1>Página Inicial</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="row-container">

        <a class="box-icon" href="{{ route('page-relatorios') }}">
            <i class="fa-solid fa-chart-simple"></i>
            <h2>Relatórios</h2>
        </a>

        <a class="box-icon" href="{{ route('page-listPedidos') }}">
            <i class="fa-solid fa-shop"></i>
            <h2>Pedidos</h2>
        </a>

        <a class="box-icon" href="{{ route('page-listProdutos') }}">
            <i class="fa-solid fa-computer"></i>
            <h2>Produtos</h2>
        </a>

        <a class="box-icon" href="{{ route('page-listClientes') }}">
            <i class="fa-solid fa-user-plus"></i>
            <h2>Clientes</h2>
        </a>

        <a class="box-icon" href="{{ route('page-listComentarios') }}">
            <i class="fa-regular fa-comments"></i>
            <h2>Feedback</h2>
        </a>

        <a class="box-icon" href="{{ route('page-listAdm') }}">
            <i class="fa-solid fa-user-tie"></i>
            <h2>Administração</h2>
        </a>

        <a class="box-icon" href="{{ route('lista-log') }}">
            <i class="fa-regular fa-file"></i>
            <h2>Log de Ações</h2>
        </a>
    </section>
@endsection
