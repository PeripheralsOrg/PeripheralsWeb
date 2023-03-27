@extends('layouts.admin')
@section('css', 'admin/index')
@section('title')@parent Login Admin @stop


@section('content')

@if ($errors->all())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Sessão_formulário_ADM -->
    <form action="/api/login/adm" method="POST">
        @csrf
        {{-- <h1>Entrar</h1> --}}
        <div class="form-inputs">
            <input type="text" required name="nome" id="inputUser" placeholder="Digite o Usuário">

            <input type="password" required name="senha" id="inputSenha" placeholder="Digite a Senha">
        </div>

        <div class="form-acoes">
            <div class="form_check">
                <input type="checkbox" name="checkConnect" id="checkBoxConnect">
                <label for="checkBoxConnect" class="form-checkbox">Manter Conectado</label>
            </div>

            <!-- Recuperação_de_senha -->
            <div class="form-link">
                <a href="">Esqueceu a Senha?</a>
            </div>
        </div>
        <br><br><br>

        <!-- Confirmar_dados_de_formulário -->
        <input type="submit" value="Logar">
    </form>
@endsection
