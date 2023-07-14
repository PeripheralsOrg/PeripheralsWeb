@extends('layouts.client')
@section('css', 'home/cadastro')
@section('js', 'valida-forms')
@section('title')@parent Cadastro @stop

@section('content')

    <!-- container start -->
    <div class="container">
        <!-- first-content start -->
        <div class="content first-content">
            <!-- second-column start -->
            <div class="second-column">

                <h2 class="title title-second">Faça seu cadastro!</h2>

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
                <form action="{{ route('client-confirmarCadastro') }}" method="GET">


                    <div class="input-group w50 container-row">
                        <input type="text" id="name" data-js="text" name="name" value="{{ old('name') }}"
                            placeholder="Digite seu nome" required class="@error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="text" id="last_name" data-js="text" value="{{ old('last_name') }}" name="last_name"
                            placeholder="Digite seu sobrenome" required class="@error('last_name') is-invalid @enderror">
                        @error('last_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group">
                        <input type="email" id="email" value="{{ old('email') }}" name="email"
                            placeholder="Digite o seu email" required class="@error('email') is-invalid @enderror">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group">
                        <input type="text" id="cpf" data-js="cpf" value="{{ old('cpf') }}" name="cpf"
                            placeholder="Digite seu CPF" required class="@error('cpf') is-invalid @enderror">
                        @error('cpf')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group w50 container-row">
                        <input type="number" id="telefone_celular" value="{{ old('telefone_celular') }}"
                            name="telefone_celular" data-js="number" placeholder="Digite seu número" required
                            class="@error('telefone_celular') is-invalid @enderror">
                            
                        @error('telefone_celular')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="email" id="email" name="confirmEmail" placeholder="Confirme seu email" required>
                    </div>

                    <div class="input-group">
                        <button class="btn btn-second">Prosseguir</button>
                    </div>
                </form>
                <!-- forms end -->
            </div>
            <!-- second-column end -->

            <!-- first-column start-->
            <div class="first-column">
                <h2 class="title title-primary">Já possui login?</h2>
                <p class="description description-primary">Se ja possuir um cadastro</p>
                <p class="description description-primary">faça seu login abaixo!</p>
                <button id="signin" class="btn btn-primary"
                    onclick="window.location.href='{{ route('client-login') }}'">Logue-se</button>
            </div>
            <!-- first-column end -->

        </div>
        <!-- first-content end -->
    </div>
    <!-- container end -->

@endsection
