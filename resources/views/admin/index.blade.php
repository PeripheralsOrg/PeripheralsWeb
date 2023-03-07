@extends('layouts.admin')
@section('css', 'admin/index')
@section('title')@parent Login Admin @stop


@section('content')
    <!-- Sessão_formulário_ADM -->
    <form action="" method="POST">
        {{-- <h1>Entrar</h1> --}}
        <div class="form-inputs">
            <input type="text" name="user" id="inputUser" placeholder="Digite o Usuário">

            <input type="password" name="senha" id="inputSenha" placeholder="Digite a Senha">
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
