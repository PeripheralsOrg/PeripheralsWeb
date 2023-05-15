@extends('layouts.admin')
@section('css', 'admin/InsertCategoria')
@section('js', 'admin/InsertCategoria')
@section('title')@parent Inserir Marca @stop


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

        <form action="{{ route('post-marca') }}" method="POST">
            @csrf
            <h2 class="title">Inserir Marca</h2>

            <label class="label-field">Marca</label>
            <input type="text" name="nome" data-js="text" required class="input-field" placeholder="Nome">

            <label class="label-field">Status</label>
            <select class="select-field" name="status">
                <option selected value="1">1 - Ativo</option>
                <option value="0">0 - Inativo</option>
            </select>

            <label class="label-field">Produtos oferecidos</label>
            <input type="text" name="descricao_atividades" data-js="text" required class="input-field" placeholder="Descrição">

            <div class="box-buttons">
                <button type="submit" class="btn-submit">Cadastrar</button>
                <button type="button" onclick="window.location.href=`{{ route('page-listConfig') }}`"
                    class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </main>

@endsection
