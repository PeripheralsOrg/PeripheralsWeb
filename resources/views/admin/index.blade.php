@extends('layouts.admin')
@section('css', 'admin/index')
@section('js', 'admin/index')
@section('title')@parent Login Admin @stop


@section('content')

    <!-- Sessão_formulário_ADM -->
    <form action="{{ route('auth-entrar') }}" method="POST">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        {{-- <h1>Entrar</h1> --}}
        <div class="form-inputs">
            <input type="text" required name="name" id="inputUser" placeholder="Digite o Usuário">

            <span class="password-container">
                <input type="password" required name="password" id="inputSenha" placeholder="Digite a Senha">
                <i id="openEye" onclick="functionEye()" class="fa-solid fa-eye"></i>
                <i id="closeEye" onclick="functionEye()" class="fa-solid fa-eye-slash"></i>
            </span>
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
