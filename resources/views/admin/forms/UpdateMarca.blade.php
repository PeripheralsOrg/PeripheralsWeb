@extends('layouts.admin')
@section('css', 'admin/InsertCategoria')
@section('js', 'admin/InsertCategoria')
@section('title')@parent Atualizar marca @stop


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
        @if (isset($getMarca))
            @foreach ($getMarca as $item)
                <form action="{{ route('update-marca', $item['id_marca']) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h2 class="title">Atualizar marca</h2>

                    <label class="label-field">Marca</label>
                    <input type="text" name="nome" value="{{$item['nome']}}" data-js="text" required class="input-field" placeholder="Nome">
                    
                    <label class="label-field">Status</label>
                    <select class="select-field" name="status">
                        @if ($item['status'] == 1)
                            <option selected value="1">1 - Ativo</option>
                            <option value="0">0 - Inativo</option>
                        @endif

                        @if ($item['status'] == 0)
                            <option value="1">1 - Ativo</option>
                            <option selected value="0">0 - Inativo</option>
                        @endif
                    </select>

                    <label class="label-field">Produtos oferecidos</label>
                    <input type="text" name="descricao_atividades"
                    value="{{$item['descricao_atividades']}}" data-js="text" required class="input-field" placeholder="Descrição">

                    <div class="box-buttons">
                        <button type="submit" class="btn-submit">Atualizar</button>
                        <button type="button" onclick="window.location.href=`{{ route('page-listConfig') }}`"
                            class="btn-cancel">Cancelar</button>
                    </div>
                </form>
            @endforeach
        @endif
    </main>

@endsection
