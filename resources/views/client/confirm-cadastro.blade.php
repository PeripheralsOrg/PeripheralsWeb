@extends('layouts.client')
@section('css', 'home/cadastro')
@section('title')@parent Confirmar Cadastro @stop

@section('content')

    <!-- container start -->
    <div class="container">
        <!-- first-content start -->
        <div class="content first-content">
            <!-- second-column start-->
            <div class="second-column">

                <h2 class="title title-second">Conclua seu cadastro!</h2>
                <!-- forms start -->
                <form action="#">

                    <div class="input-group">
                        <input type="email" id="email" placeholder="Confirme o seu email" required>
                    </div>

                    <div class="input-group w50 container-row">
                        <input type="password" id="password" placeholder="Digite sua senha" required>
                        <input type="password" id="confirmpassword" placeholder="Confirme sua senha" required>
                    </div>


                    <div class="checks-conditions">
                        <span class="condicoes"><input type="checkbox">Receber novidades?</span>
                        <span class="condicoes">
                            <input type="checkbox">Aceite nossos <a id="termosAgree" href="#">termos</a></span>
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
                <button id="signin" class="btn btn-primary" onclick="window.location.href='{{route('client-login')}}'">Logue-se</button>
            </div>

        </div>
        <!-- fist-content end-->
    </div>
    <!-- container end-->

@endsection
