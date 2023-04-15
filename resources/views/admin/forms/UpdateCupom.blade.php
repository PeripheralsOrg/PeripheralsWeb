@extends('layouts.admin')
@section('css', 'admin/InsertCupom')
@section('js', 'admin/InsertAdm')
@section('title')@parent Inserir Cupom @stop


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

    <main class="content-cupom">

        <form action="{{ route('post-cupom') }}" method="POST">
            @csrf
            <h2 class="title">Inserir Cupom</h2>

            <label class="label-field">Nome</label>
            <input type="text" name="name" data-js="text" required class="input-field" placeholder="Nome">

            <label class="label-field">Código</label>
            <input type="text" name="codigo" data-js="text" required class="input-field" placeholder="Código">

            <div class="row-input">
                <label class="label-field">Data de Expiração</label>
                <input type="date" name="data_expiracao" data-js="text" required class="input-field"
                    placeholder="Expiração">

                <label class="label-field">Porcentagem</label>
                <input type="text" name="porcentagem" data-js="decimal" required class="input-field" placeholder="Porcentagem de Desconto">
            </div>

            <label class="label-field">Status</label>
            <select class="select-field" name="status">
                <option value="1">1 - Ativo</option>
                <option value="0">0 - Inativo</option>
            </select>

            <div class="box-buttons">
                <button type="submit" class="btn-submit">Cadastrar</button>
                <button type="button" onclick="window.location.href=`{{ route('page-listCupons') }}`"
                    class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </main>

@endsection
