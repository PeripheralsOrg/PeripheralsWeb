@extends('layouts.client')
@section('css', 'home/my-info')
@section('title')@parent Editar informações @stop

@section('content')

    <main class="container-edit">
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
        @if ($type == 'common')
            <form action="{{ route('client-infoEdit') }}" class="form-edit">
                <div class="box-input">
                    <label for="">Nome</label>
                    <input required type="text" name="name" placeholder="Nome"
                        value="{{ Session::get('user')['name'] }}">
                </div>

                <div class="box-input">
                    <label for="">Último Nome</label>
                    <input required type="text" name="last_name" placeholder="Nome"
                        value="{{ Session::get('user')['last_name'] }}">
                </div>

                <div class="box-input">
                    <label for="">Telefone Celular</label>
                    <input required data-js="phone" type="text" name="telefone_celular" placeholder="Celular"
                        value="{{ Session::get('user')['telefone_celular'] }}">
                </div>

                <div class="box-input">
                    <label for="">Receber emails sobre promoções e cupons?</label>
                    <div class="row-feedback">
                        <p><input type="radio" name="feedback" value="1">Sim</p>
                        <p><input type="radio" name="feedback" value="0">Não</p>
                    </div>
                </div>
                <button>Atualizar</button>
            </form>
        @endif

        @if ($type == 'email')
            <form action="{{ route('client-emailEdit') }}" class="form-edit">
                <div class="box-input">
                    <label for="">Email</label>
                    <input required type="email" name="email" placeholder="Email"
                        value="{{ Session::get('user')['email'] }}">
                </div>

                <div class="box-input">
                    <label for="">Confirmar Email</label>
                    <input required type="email" name="confirmEmail" placeholder="Confirme o email digitado">
                </div>

                <button>Atualizar</button>
            </form>
        @endif
        <button id="getBackBtn" onclick="window.location.href='{{ route('client-info') }}'">Voltar</button>

    </main>

@endsection
