@extends('layouts.client')
@section('css', 'home/endereco')
@section('title')@parent Endereço de Entrega @stop

@section('content')
    <main class="content-endereco">

        <form action="#">
            <h2 id="firstTitle">Endereços Cadastrados</h2>

            <section class="conteiner-getEndereco">
                <div class="box-endereco">
                    <div class="row-info">
                        <p>Logradouro</p>
                        <p>Número</p>
                    </div>
                    <div class="row-info">
                        <p>CEP</p>
                        <input type="radio" name="#" id="selectEndereco">
                    </div>
                </div>
            </section>
        </form>

        <form class="content-form">
            <h2 id="firstTitle">Cadastrar Endereço</h2>


            <div class="row-cep">
                <div class="box-inputCep">
                    {{-- TODO: #69 Criar a validação por CEP --}}
                    <input type="text" data-js="text" required class="input-field" placeholder="CEP">
                </div>
                <button type="button" id="btnCep">Localizar</button>
            </div>

            <div class="row-input">
                <div class="box-input">
                    <label class="label-field">Logradouro</label>
                    <input type="text" data-js="text" required class="input-field" placeholder="Logradouro"
                        value="">
                </div>
                <div class="box-input">
                    <label class="label-field">Número</label>
                    <input type="text" data-js="text" required class="input-field" placeholder="Número" value="">
                </div>
            </div>

            <label class="label-field">Tipo de Logradouro</label>
            <select name="tipo_logradouro" id="#">
                <option value="avenida">Avenida</option>
            </select>

            <div class="row-input">
                <div class="box-input">
                    <label class="label-field">Bairro</label>
                    <input type="text" data-js="text" required class="input-field" placeholder="Bairro" value="">
                </div>
                <div class="box-input">
                    <label class="label-field">Complemento</label>
                    <input type="text" data-js="text" required class="input-field" placeholder="Complemento"
                        value="">
                </div>
            </div>

            <div class="row-input">
                <div class="box-input">
                    <label class="label-field">Estado</label>
                    <input type="text" data-js="text" required class="input-field" placeholder="CPF" value="">
                </div>
                <div class="box-input">
                    <label class="label-field">Cidade</label>
                    <input type="text" data-js="text" required class="input-field" placeholder="Cidade"
                        value="">
                </div>
            </div>

            <label class="label-field">Ponto de Referência</label>
            <input type="text" data-js="text" required class="input-field" placeholder="Ponto de Referência"
                value="">


            <div class="box-buttons">
                <button type="submit" class="btn-delete">Cadastrar</button>
            </div>
        </form>

    </main>

@endsection
