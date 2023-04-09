@extends('layouts.admin')
@section('css', 'admin/InsertMenu')
@section('js', 'admin/InsertMenu')
@section('title')@parent Inserir Menu @stop


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

    <main class="content-menu">

        <form action="{{ route('post-userAdm') }}" method="POST">
            @csrf
            <h2 class="title">Inserir menu</h2>

            <label class="label-field">Titulo</label>
            <input type="text" name="titulo" data-js="text" required class="input-field" placeholder="Titulo">

            <label class="label-field">URL</label>
            <input type="text" name="link_menu" data-js="text" required class="input-field" placeholder="Link">

            <label class="label-field">Status</label>
            <select class="select-field" name="status">
                <option value="1">1 - Ativo</option>
                <option value="0">0 - Inativo</option>
            </select>

            <div class="box-buttons">
                <button type="submit" class="btn-submit">Cadastrar</button>
                <button type="button" onclick="window.location.href=`{{ route('page-listAdm') }}`"
                    class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </main>

@endsection
