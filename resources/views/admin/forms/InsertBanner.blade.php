@extends('layouts.admin')
@section('css', 'admin/InsertBanner')
@section('js', 'admin/InsertBanner')
@section('title')@parent Inserir Banner @stop


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

    <main class="content-banner">

        <form action="{{ route('post-banner') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="title">Inserir Banner</h2>

            <label class="label-field">Nome</label>
            <input type="text" name="nome_banner" data-js="text" required class="input-field" placeholder="Titulo">

            <label class="label-field">URL</label>
            <input type="text" name="link_route" data-js="text" required class="input-field" placeholder="Link">

            <label class="label-field">Status</label>
            <select class="select-field" name="status">
                <option value="1">1 - Ativo</option>
                <option value="0">0 - Inativo</option>
            </select>

            <label class="label-field">Banner</label>
            <input type="file" name="link_img" accept="image/*" data-js="image" required 
            class="input-field" placeholder="Banner">

            <div class="box-buttons">
                <button type="submit" class="btn-submit">Cadastrar</button>
                <button type="button" onclick="window.location.href=`{{ route('page-listAdm') }}`"
                    class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </main>

@endsection
