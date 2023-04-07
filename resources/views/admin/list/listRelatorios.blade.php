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
    </main>

@endsection
