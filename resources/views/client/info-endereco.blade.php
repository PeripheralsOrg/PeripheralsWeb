@extends('layouts.client')
@section('css', 'home/meus-enderecos')
@section('js', 'home/endereco')
@section('title')@parent Meus Endereços @stop

@section('content')
    <main class="content-endereco">

        <form action="{{ route('delete-enderecoInfo') }}" method="GET">
            <h2 id="firstTitle">Endereços Cadastrados</h2>

            @if (!empty($endereco))

                <section class="conteiner-getEndereco">
                    @foreach ($endereco as $item)
                        <div class="box-endereco">
                            <div class="row-info">
                                <p>{{ $item['logradouro'] }}</p>
                                <p>{{ $item['numero'] }}</p>
                            </div>
                            <div class="row-info">
                                <p>{{ $item['cep'] }}</p>
                                <input type="radio" required name="id_endereco" value="{{ $item['id_endereco'] }}"
                                    id="selectEndereco">
                            </div>
                        </div>
                    @endforeach

                </section>
            @else
                <h3>{{ $erro }}</h3>
            @endif
            <div class="box-buttons">
                <button type="submit" class="btn-delete">Apagar endereço selecionado</button>
            </div>
        </form>

        @if ($errors->any())
            <div class="container-error">
                <i class="fa-sharp fa-solid fa-circle-exclamation" style="color: #FFFF;"></i>
                @foreach ($errors->all() as $error)
                    <p id="txt-error">
                        {{ $error }}
                    </p>
                @endforeach
            </div>
        @endif

        <form class="content-form" action="{{ route('register-infoEndereco') }}" method="POST">
            <h2 id="firstTitle">Cadastrar Endereço</h2>

            @csrf
            @method('POST')

            <div class="row-cep">
                <div class="box-inputCep">
                    <input type="text" data-js="cep" required name="cep" required class="input-field"
                        placeholder="CEP" maxlength="10" id="inputCep">
                </div>
                <button type="button" id="btnCep">Localizar</button>
            </div>

            <div class="row-input">
                <div class="box-input">
                    <label class="label-field">Logradouro</label>
                    <input required type="text" name="logradouro" data-js="text" required class="input-field"
                        placeholder="Logradouro" value="" id="logradouro">
                </div>
                <div class="box-input">
                    <label class="label-field">Número</label>
                    <input required type="text" name="numero" data-js="text" required class="input-field"
                        placeholder="Número" value="">
                </div>
            </div>

            <label class="label-field">Tipo de Logradouro</label>
            <select required name="tipo_logradouro" id="tipo_logradouro">
                <option value="0">Selecionar</option>
                <option value="avenida">Aeroporto</option>
                <option value="avenida">Alameda</option>
                <option value="avenida">Avenida</option>
                <option value="avenida">Área</option>
                <option value="avenida">Avenida</option>
                <option value="avenida">Campo</option>
                <option value="avenida">Condomínio</option>
                <option value="avenida">Conjunto</option>
                <option value="avenida">Estrada</option>
                <option value="avenida">Chácara</option>
                <option value="avenida">Fazenda</option>
                <option value="avenida">Residencial</option>
                <option value="avenida">Rodovia</option>
                <option value="avenida">Rua</option>
                <option value="avenida">Travessa</option>
                <option value="avenida">Via</option>
                <option value="avenida">Viaduto</option>
                <option value="avenida">Viela</option>
                <option value="avenida">Vila</option>
            </select>

            <div class="row-input">
                <div class="box-input">
                    <label class="label-field">Bairro</label>
                    <input required type="text" name="bairro" data-js="text" required class="input-field"
                        placeholder="Bairro" value="" id="bairro">
                </div>
                <div class="box-input">
                    <label class="label-field">Complemento</label>
                    <input type="text" name="complemento" data-js="text" required class="input-field"
                        placeholder="Complemento" value="" id="complemento">
                </div>
            </div>

            <div class="row-input">
                <div class="box-input">
                    <label class="label-field">UF</label>
                    <input required type="text" name="estado" max="2" id="uf" data-js="text" required
                        class="input-field" placeholder="UF" value="">
                </div>
                <div class="box-input">
                    <label class="label-field">Cidade</label>
                    <input required type="text" name="cidade" id="localidade" data-js="text" required
                        class="input-field" placeholder="Cidade" value="">
                </div>
            </div>

            <label class="label-field">Ponto de Referência</label>
            <input required type="text" name="ponto_ref" data-js="text" required class="input-field"
                placeholder="Ponto de Referência" value="">


            <div class="box-buttons">
                <button type="submit" class="btn-delete">Cadastrar</button>
            </div>
        </form>
        <button id="getBackBtn" onclick="window.location.href='{{ route('client-info') }}'">Voltar</button>

    </main>

@endsection
