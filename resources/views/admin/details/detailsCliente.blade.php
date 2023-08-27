@extends('layouts.admin')
@section('css', 'admin/detailsCliente')


@section('content')
    {{-- Exibição de erros --}}
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

    <main class="content-cliente">

        <article>
            @foreach ($user as $item)
                <h2 id="firstTitle">Cliente ID: {{ $item['id'] }}</h2>

                @section('title')@parent Cliente {{ $item['id'] }} @stop
                <div class="row-input">
                    <div class="box-input">
                        <label class="label-field">Nome</label>
                        <input disabled type="text" data-js="text" required class="input-field" placeholder="Nome"
                            value="{{ $item['name'] }}">
                    </div>
                    <div class="box-input">
                        <label class="label-field">Último nome</label>
                        <input disabled type="text" data-js="text" required class="input-field" placeholder="Último nome"
                            value="{{ $item['last_name'] }}">
                    </div>
                </div>


                <label class="label-field">Email</label>
                <input disabled type="text" data-js="text" required class="input-field" placeholder="Email"
                    value="{{ $item['email'] }}">

                <div class="row-input">
                    <div class="box-input">
                        <label class="label-field">CPF</label>
                        <input disabled type="text" data-js="text" required class="input-field" placeholder="CPF"
                            value="{{ $item['cpf'] }}">
                    </div>
                    <div class="box-input">
                        <label class="label-field">Telefone Celular</label>
                        <input disabled type="text" data-js="text" required class="input-field"
                            placeholder="Telefone Celular" value="{{ $item['telefone_celular'] }}">
                    </div>
                </div>

                <label class="label-field">Usuário criado em</label>
                <input type="text" disabled data-js="text" required class="input-field" placeholder="data"
                    value="{{ Carbon\Carbon::parse($item['created_at'])->format('d/m/Y h:i:s') }}">

                <p>Feedback: <span id="infoDestaque">{{ $item['feedback'] ? 'Ativo' : 'Desativado' }}</span></p>
                <p>Login Google: <span id="infoDestaque">{{ $item['google_id'] ? 'Ativo' : 'Desativado' }}</span></p>
                <p>Login Linkedin: <span id="infoDestaque">{{ $item['linkedin_id'] ? 'Ativo' : 'Desativado' }}</span></p>
                <p>Email verificado: <span id="infoDestaque">{{ $item['email_verified_at'] ? 'Ativo' : 'Desativado' }}</span></p>

            @endforeach

        </article>

        <article class="content-endereco">
            <h1>Endereços Cadastrados</h1>

            @if (count($getEndereco) > 0)

                @foreach ($getEndereco as $item)
                    <div class="box-endereco">
                        <h3>Endereco {{ $item['id_endereco'] }}</h3>
                        <div class="row-endereco">
                            <div class="box-inputEndereco">
                                <label class="label-field">Estado</label>
                                <input type="text" data-js="text" required class="input-field" placeholder="Estado"
                                    value="{{ $item['estado'] }}">
                            </div>
                            <div class="box-inputEndereco">
                                <label class="label-field">Cidade</label>
                                <input type="text" data-js="text" required class="input-field" placeholder="Cidade"
                                    value="{{ $item['cidade'] }}">
                            </div>
                        </div>

                        <div class="row-endereco">
                            <div class="box-inputEndereco">
                                <label class="label-field">Logradouro</label>
                                <input type="text" data-js="text" required class="input-field" placeholder="Logradouro"
                                    value="{{ $item['logradouro'] }}">
                            </div>
                            <div class="box-inputEndereco">
                                <label class="label-field">CEP</label>
                                <input type="text" data-js="text" required class="input-field" placeholder="CEP"
                                    value="{{ $item['cep'] }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p id="errorEndereco">Nenhum endereço cadastrado!</p>
            @endif

            @foreach ($user as $item)
                @if ($item['status'] == 1)
                    <div class="box-buttons">
                        <button type="submit" class="btn-delete"
                            onclick="window.location.href='{{ route('client-delete', $item['id']) }}'">Desativar
                            Usuário</button>

                        <button type="submit" class="btn-delete"
                            onclick="window.location.href='{{ route('page-listClientes') }}'">Voltar</button>

                    </div>
                @else
                    <div class="box-buttons">
                        <button type="submit" class="btn-active"
                            onclick="window.location.href='{{ route('client-active', $item['id']) }}'">Ativar
                            Usuário</button>
                        <button type="submit" class="btn-delete"
                            onclick="window.location.href='{{ route('page-listClientes') }}'">Voltar</button>
                    </div>
                @endif
            @endforeach
        </article>
    </main>

@endsection
