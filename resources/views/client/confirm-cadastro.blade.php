@extends('layouts.client')
@section('css', 'home/cadastro')
@section('js', 'valida-forms')
@section('title')@parent Confirmar Cadastro @stop

@section('content')

    <!-- container start -->
    <div class="container">
        <!-- first-content start -->
        <div class="content first-content">
            <!-- second-column start-->
            <div class="second-column">

                <h2 class="title title-second">Conclua seu cadastro!</h2>

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


                <!-- forms start -->
                <form action="{{ route('register-user') }}" method="POST" 
                class="form-confirm" id="formCadastroConfirm">
                    <p id="exibError"></p>

                    @csrf
                    @method('POST')

                    @foreach (Request::all() as $item => $key)
                        <input type="hidden" name="{{ $item }}" value="{{ $key }}">
                    @endforeach

                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder="Digite sua senha" required>
                    </div>

                    <div class="input-group container-row">
                        <input type="password" name="senhaConfirm" id="senhaConfirm" placeholder="Confirme sua senha"
                            required>
                    </div>

                    <div class="checks-conditions">
                        <span class="condicoes"><input type="checkbox" name="feedback">Deseja receber novidades?</span>
                        <span class="condicoes">
                            <input id="termoCheck" type="checkbox">Aceite nossos <a id="termosAgree"
                                href="#">termos</a>
                        </span>
                    </div>

                    <div class="input-group">
                        <button class="btn btn-second">Cadastrar</button>
                    </div>

                </form>
                <!-- forms end -->

            </div>
            <!-- second-column end -->
            <div class="first-column">
                <h2 class="title title-primary">Já possui login?</h2>
                <p class="description description-primary">se ja possuir um cadastro</p>
                <p class="description description-primary">faça seu login abaixo!</p>
                <button id="signin" class="btn btn-primary"
                    onclick="window.location.href='{{ route('client-login') }}'">Logue-se</button>
            </div>

        </div>
        <!-- fist-content end-->
    </div>
    <!-- container end-->

@endsection
