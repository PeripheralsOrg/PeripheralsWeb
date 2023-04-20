@extends('layouts.admin')
@section('css', 'admin/InsertProduto')
@section('title')@parent Inserir produto @stop


@section('content')

    <main class="content-product">

        <form action="#">
            <h2 class="title">Inclusão de Produtos</h2>

            <label class="label-field">Código de Produto</label>
            <input type="text" class="input-field" placeholder="Código">

            <label class="label-field">Imagem Principal</label>
            <input type="file" accept="image/*" class="input-field">

            <label class="label-field">Imagem Secundárias</label>
            <input type="file" accept="image/*" class="input-field">

            <label class="label-field">Nome do Produto</label>
            <input type="text" class="input-field" placeholder="Nome do produto">

            <label class="label-field">Marca</label>
            <select class="select-field" name="#">
                <option value="#">Selecione</option>
            </select>

            <label class="label-field">Categoria</label>
            <select class="select-field" name="#">
                <option value="#">Selecione</option>
            </select>

            <label class="label-field">Descrição do Produto</label>
            <textarea type="text" class="input-field textarea-field" placeholder="Descrição"></textarea>

            <label class="label-field">Preço do Produto</label>
            <input type="text" class="input-field" placeholder="R$ 00,00">

            <label class="label-field">Quantidade em Estoque</label>
            <input type="text" class="input-field" placeholder="Qtd 0.">

            <div class="box-buttons">
                <button type="submit" class="btn-submit">Cadastrar</button>
                <button type="button" class="btn-cancel" 
                onclick="window.location.href=`{{ route('page-listProdutos') }}`"
                    class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </main>

@endsection
