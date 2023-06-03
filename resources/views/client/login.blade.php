@extends('layouts.client')
@section('css', 'home/login')
@section('title')@parent Login @stop

@section('content')

    <!-- Container start -->
    <div class="container">
        <!-- first-content start-->
        <div class="content first-content">
            <!-- first-culumn start-->
            <div class="first-column">
                <h2 class="title title-primary">Primeira vez aqui!</h2>
                <p class="description description-primary">faça ja seu cadastro</p>
                <p class="description description-primary">e fique por dentro de tudo!</p>
                <button id="signin" class="btn btn-primary">cadastre-se</button>
            </div>
            <!-- first-column end-->

            <!-- second-column start-->
            <div class="second-column">
                <h2 class="title title-second">Faça seu login</h2>

                <!-- form start -->
                <form class="form">

                    <div class="label-input" for="">
                        <input type="email" placeholder="Email ou CPF">
                        <i class="far fa-envelope icon-modify"></i>
                    </div>

                    <div class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" placeholder="Password">
                        <i class="fas fa-eye icon-eye"></i>
                    </div>

                    <div class="checks">
                        <span class="condicoes"><input type="checkbox">mantenha-me logado</span>

                        <span class="forgotten-password"><a href="#">Esqueceu sua senha</a></span>

                    </div>


                    <button class="btn btn-second">logar</button>

                </form>
                <!-- form end -->

                <!-- social-media start -->
                <p class="ou">ou</p>

                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media1">
                                <i class="fab fa-twitter"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media2">
                                <i class="fab fa-google-plus-g"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media3">
                                <i class="fab fa-linkedin-in"></i>
                            </li>
                        </a>
                    </ul>
                </div>
                <!-- social-media end -->
            </div>
            <!-- second-column end-->
        </div>
        <!-- first-content end-->
    </div>
    <!-- Container end-->

@endsection
