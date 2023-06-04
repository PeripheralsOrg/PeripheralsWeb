@extends('layouts.client')
@section('css', 'home/cadastro')
@section('title')@parent Cadastro @stop

@section('content')

    <!-- container start -->
    <div class="container">
        <!-- first-content start -->
        <div class="content first-content">
            <!-- second-column start -->
            <div class="second-column">

                <h2 class="title title-second">Faça seu cadastro!</h2>

                <!-- forms start -->
                <form action="#">

                    <div class="input-group w50">
                        <input type="text" id="name" placeholder="Digite seu nome" required>
                    </div>

                    <div class="input-group w50">
                        <input type="text" id="lastname" placeholder="Digite seu sobrenome" required>
                    </div>

                    <div class="input-group">
                        <input type="email" id="email" placeholder="Digite o seu email" required>
                    </div>

                    <div class="input-group">
                        <input type="text" id="cpf" placeholder="Digite seu CPF" required>
                    </div>

                    <div class="input-group w50">
                        <input type="tel" id="cel" placeholder="Digite seu número" required>
                    </div>

                    <div class="input-group w50">
                        <input type="text" id="cep" placeholder="Digite seu CEP" required>
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
                <button id="signin" class="btn btn-primary" onclick="window.location.href='{{route('client-login')}}'">Logue-se</button>
            </div>
            <!-- first-column end -->

        </div>
        <!-- first-content end -->
    </div>
    <!-- container end -->

@endsection
