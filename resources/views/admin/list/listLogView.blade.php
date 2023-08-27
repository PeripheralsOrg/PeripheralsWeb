@extends('layouts.admin')
@section('css', 'admin/listUserAdm')
@section('title')@parent Usuários Administrativos @stop

@section('content')

    <!-- Titulo -->
    <main class="container-users">
        <h1>Log de Ações</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="textViewLog">
            {!! nl2br(e($fileContent)) !!}
        </div>

        
        <button id="logBtn" onclick="window.location.href=`{{ route('baixar-log') }}`">
            Baixar Arquivo
        </button>

    </main>

@endsection
