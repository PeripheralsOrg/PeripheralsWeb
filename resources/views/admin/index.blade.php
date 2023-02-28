@extends('layouts.admin')
@section('css', 'admin/index')
@section('title')@parent Login Admin @stop


<!-- Sessão_formulário_ADM -->
<form action="" method="POST">
    {{-- <h1>Entrar</h1> --}}
    <div id="form-inputs">
        <input type="text" name="user" id="input-user" placeholder="Digite o Usuário">

        <input type="password" name="senha" id="input-senha" placeholder="Digite a Senha">
    </div>

    <div id="form-acoes">
        <div id="form-check">
            <input type="checkbox" name="check-conect" id="checkbox-conect">
            <label for="checkbox-conect" class="form-checkbox">Manter Conectado</label>
        </div>

        <!-- Recuperação_de_senha -->
        <div id="form-link">
            <a href="">Esqueceu a Senha?</a>
        </div>
    </div>
    <br><br><br>

    <!-- Confirmar_dados_de_formulário -->
    <input type="submit" value="Logar">

</form>
