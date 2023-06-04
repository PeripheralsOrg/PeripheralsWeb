@extends('layouts.client')
@section('css', 'home/contato')
@section('title')@parent Contato @stop

@section('content')

    <!-- Container start -->
    <div class="container">
        <!-- first-content start -->
        <div class="content first-content">
            <!-- second-column start -->
            <div class="second-column">

                <h2 class="title title-second">Contate-nos!</h2>
                <!-- forms start -->
                <form action="#">

                    <div class="input-group w50 container-row">
                        <input type="text" id="name" placeholder="Digite seu nome" required>
                        <input type="text" id="lastname" placeholder="Digite seu sobrenome" required class="nome">
                    </div>

                    <div class="input-group">
                        <input type="email" id="email" placeholder="Digite o seu email" required>
                    </div>

                    <div class="input-group">
                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Digite sua mensagem"></textarea>
                    </div>

                    <div class="input-group">
                        <button class="btn btn-second">Prosseguir</button>
                    </div>

                </form>
                <!-- forms end-->
            </div>
            <!-- second-column end-->

            <!-- first-column start -->
            <div class="first-column">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3655.731127517571!2d-46.69954272526328!3d-23.613973863526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce50ceee6fd2cf%3A0x228e8bc004a4e470!2sETEC%20Jornalista%20Roberto%20Marinho!5e0!3m2!1spt-BR!2sbr!4v1684593220348!5m2!1spt-BR!2sbr"
                    width="" height="" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <!-- first-column end -->

        </div>
        <!-- first-content end -->
    </div>
    <!-- Container end -->
@endsection
