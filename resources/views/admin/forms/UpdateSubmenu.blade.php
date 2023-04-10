@extends('layouts.admin')
@section('css', 'admin/InsertMenu')
@section('js', 'admin/InsertMenu')
@section('title')@parent Atualizar Submenu @stop


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
        @if (!empty($getSubmenu))
            @foreach ($getSubmenu as $itemSub)
                <form action="{{ route('update-submenu', $itemSub['id']) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <h2 class="title">Atualizar Submenu</h2>

                    <label class="label-field">Titulo</label>
                    <input type="text" name="titulo_submenu" value="{{$itemSub['titulo_submenu']}}" data-js="text" required class="input-field"
                        placeholder="Titulo">

                    <label class="label-field">URL</label>
                    <input type="text" name="link_submenu" value="{{$itemSub['link_submenu']}}" data-js="text" required class="input-field"
                        placeholder="Link">

                    @if (isset($getMenus))
                        <label class="label-field">Menus</label>
                        <select class="select-field" name="id_menu">
                            @foreach ($getMenus as $item)
                                <option value="{{ $item['id'] }}">{{ $item['titulo'] }}</option>
                            @endforeach
                        </select>
                    @endif

                    <label class="label-field">Status</label>
                    <select class="select-field" name="status">
                        @if ($itemSub['status'] == 1)
                            <option selected value="1">1 - Ativo</option>
                            <option value="0">0 - Inativo</option>
                        @endif

                        @if ($itemSub['status'] == 0)
                            <option value="1">1 - Ativo</option>
                            <option selected value="0">0 - Inativo</option>
                        @endif
                    </select>

                    <div class="box-buttons">
                        <button type="submit" class="btn-submit">Atualizar</button>
                        <button type="button" onclick="window.location.href=`{{ route('page-listMenus') }}`"
                            class="btn-cancel">Cancelar</button>
                    </div>
                </form>
            @endforeach
        @endif
    </main>

@endsection
