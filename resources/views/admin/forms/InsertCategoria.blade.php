@extends('layouts.admin')
@section('css', 'admin/InsertCategoria')
@section('js', 'admin/InsertCategoria')
@section('title')@parent Inserir Categoria @stop


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

    <main class="content-categoria">

        <form action="{{ route('post-categoria') }}" method="POST">
            @csrf
            <h2 class="title">Inserir Categoria</h2>

            <label class="label-field">Categoria</label>
            <input type="text" name="categoria" data-js="text" required class="input-field" placeholder="Nome">

            <div class="box-buttons">
                <button type="submit" class="btn-submit">Cadastrar</button>
                <button type="button" onclick="window.location.href=`{{ route('page-listConfig') }}`"
                    class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </main>

@endsection
