@extends('layouts.admin')
@section('css', 'admin/InsertCategoria')
@section('js', 'admin/InsertCategoria')
@section('title')@parent Atualizar Categoria @stop


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
        @if (isset($getCategoria))
            @foreach ($getCategoria as $item)
                <form action="{{ route('update-categoria', $item['id_categoria']) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h2 class="title">Atualizar Categoria</h2>

                    <label class="label-field">Categoria</label>
                    <input type="text" name="categoria" value="{{$item['categoria']}}" data-js="text" required class="input-field" placeholder="Nome">

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
