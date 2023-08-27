@extends('layouts.admin')
@section('css', 'admin/InsertProduto')
@section('js', 'admin/UpdateProduto')
@section('title')@parent Atualizar produto @stop


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

    <main class="content-product">

        @if (!empty($produto))
            @foreach ($produto as $item)
                <form action="{{ route('update-produto', $item['id_produtos']) }}" method="POST" enctype="multipart/form-data"
                    id="formUpdateProduto">
                    @csrf
                    @method('PATCH')
                    <h2 class="title">Atualização de Produto</h2>

                    <label class="label-field">Código de Produto</label>
                    <input type="text" data-js="number" value="{{ $item['codigo'] }}" name="codigo" maxlength="20"
                        class="input-field" placeholder="Código">

                    <label class="label-field">Nome do Produto</label>
                    <input type="text" data-js="text" value="{{ $item['nome'] }}" name="nome" class="input-field"
                        placeholder="Nome do produto">

                    <label class="label-field">Modelo</label>
                    <input type="text" data-js="text" value="{{ $item['modelo'] }}" name="modelo" class="input-field"
                        placeholder="Modelo">

                    <label class="label-field">Preço do Produto</label>
                    <input type="text" data-js="money" value="{{ $item['preco'] }}" name="preco" class="input-field"
                        placeholder="R$ 00,00">

                    <label class="label-field">Quantidade em Estoque</label>
                    <input type="text" data-js="number" value="{{ $item['quantidade'] }}" name="quantidade"
                        class="input-field" placeholder="Qtd 0.">

                    @if (!empty($categorias))
                        <label class="label-field">Categoria</label>
                        <select class="select-field" name="categoria" id="selectCategoria">
                            @foreach ($categorias as $itemC)
                                <option value="{{ $itemC['id_categoria'] }}">{{ $itemC['categoria'] }}</option>
                            @endforeach
                        </select>
                    @endif

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

                    <label class="label-field">Descrição do Produto</label>
                    <textarea type="text" data-js="text" name="descricao" class="input-field textarea-field" placeholder="Descrição">{{ $item['descricao'] }}</textarea>

                    {{-- FORMULARIO DE INFORMAÇÕES ADICIONAIS --}}
                    <div class="container-more-info">
                        <h2>Informações Adicionais</h2>

                        {{-- Informações padrões, que precisam ter em todos os produtos --}}
                        <div class="box-inputs" id="boxPadrao">
                            <div class="box-row">
                                <label class="label-field">Fonte de Energia
                                    <input type="text" data-js="text" value="{{ $item['fonte_energia'] }}"
                                        name="fonte_energia" class="input-field" placeholder="Energia">
                                </label>
                                <label class="label-field">Tamanho
                                    <input type="text" data-js="text" value="{{ $item['tamanho'] }}" name="tamanho"
                                        class="input-field" placeholder="Tamanho">
                                </label>
                            </div>

                            <div class="box-row">
                                <label class="label-field">Conexões
                                    <input type="text" data-js="text" value="{{ $item['conexao'] }}" name="conexao"
                                        class="input-field" placeholder="Conexões">
                                </label>
                                <label class="label-field">Cor
                                    <input type="text" data-js="text" value="{{ $item['cor'] }}" name="cor"
                                        class="input-field" placeholder="Cor">
                                </label>
                            </div>

                            <div class="box-row">
                                <label class="label-field">Material
                                    <input type="text" data-js="text" value="{{ $item['material'] }}"
                                        name="material" class="input-field" placeholder="Material">
                                </label>
                                <label class="label-field">Peso
                                    <input type="text" data-js="text" value="{{ $item['peso'] }}" name="peso"
                                        class="input-field" placeholder="Peso">
                                </label>
                            </div>

                            <label class="label-field">É Promoção?</label>
                            <select class="select-field" name="is_promocao">
                                @if ($item['is_promocao'] == 1)
                                    <option value="0">Não</option>
                                    <option selected value="1">Sim</option>
                                @endif

                                @if ($item['is_promocao'] == 0)
                                    <option selected value="0">Não</option>
                                    <option value="1">Sim</option>
                                @endif
                            </select>

                            {{-- TODO: Input não permite espaços --}}
                            <label class="label-field" id="inputGarantia">Garantia
                                <input type="text" data-js="text" value="{{ $item['garantia'] }}" name="garantia"
                                    class="input-field" placeholder="Garantia">
                            </label>
                        </div>

                        {{-- Informações para monitores --}}
                        @if ($item['categoria'] === 'Monitor')
                            <div class="box-inputs options" id="boxMonitor">
                                <label class="label-field">Tipo de áudio
                                    <input type="text" data-js="text" name="tipo_audio[]" class="input-field"
                                        placeholder="Áudio">
                                </label>
                                <label class="label-field">Tipo de Tela
                                    <input type="text" data-js="text" name="tipo_tela" class="input-field"
                                        placeholder="Tela">
                                </label>
                                <label class="label-field">Resolução
                                    <input type="text" data-js="text" name="resolucao" class="input-field"
                                        placeholder="Resolução">
                                </label>
                                <label class="label-field">Frequência
                                    <input type="text" data-js="text" name="frequencia" class="input-field"
                                        placeholder="Resolução">
                                </label>
                            </div>
                        @endif

                        {{-- Informações para headset --}}
                        @if ($item['categoria'] === 'Headset')
                            <div class="box-inputs options" id="boxAudio">
                                <label class="label-field">Tipo de áudio
                                    <input type="text" data-js="text" name="tipo_audio[]" class="input-field"
                                        placeholder="Áudio">
                                </label>
                                <label class="label-field">Microfone
                                    <input type="text" data-js="text" name="microfone" class="input-field"
                                        placeholder="Microfone">
                                </label>
                                <label class="label-field">Tecnologia
                                    <input type="text" data-js="text" name="tecnologia" class="input-field"
                                        placeholder="Tecnologia">
                                </label>
                            </div>
                        @endif
                        {{-- Informações para teclados --}}
                        @if ($item['categoria'] === 'Teclado')
                            <div class="box-inputs options" id="boxTeclado">
                                <label class="label-field">Tipo de Teclado
                                    <input type="text" data-js="text" name="tipo_teclado" class="input-field"
                                        placeholder="Tipo">
                                </label>
                            </div>
                        @endif

                        {{-- Informações para mouse --}}
                        @if ($item['categoria'] === 'Mouse')
                            <div class="box-inputs options" id="boxMouse">
                                <label class="label-field">DPI
                                    <input type="text" data-js="text" name="dpi" class="input-field"
                                        placeholder="DPI">
                                </label>
                            </div>
                        @endif
                        <label class="label-field" id="labelTextarea">Informações Adicionais
                            <textarea type="text" name="info_adicional" data-js="text" class="input-field textarea-field"
                                placeholder="Descrição">{{ $item['info_adicional'] }}</textarea>
                        </label>
                    </div>
            @endforeach

            <input type="hidden" name="delete_image[]" id="inputDeleteImg">
            @if (!empty($imgs))
                @foreach ($imgs as $img)
                    <div class="box-img">
                        <h3>{{ $img['nome_img'] }} - {{ str_replace('public/storage/', '', $img['link_img']) }}</h3>
                        <div class="row-img">
                            <img src="{{ asset(str_replace('public/', '', $img['link_img'])) }}"
                                alt="{{ $img['nome_img'] }}">
                            <button type="button" id="deleteImg"
                                onclick="deletarImg('{{ $img['id_produto_imgs'] }}', '{{ str_replace('public/storage/', '', $img['link_img']) }}')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <p id="msgImg"></p>
                        </div>
                    </div>
                @endforeach
                <label class="label-field">Imagem Principal</label>
                <input type="file" accept="image/*" name="imagem_principal" id="imageInput" class="input-field">

                <label for="img_principal">Outras Imagens </label>
                <input type="file" name="link_img[]" accept="image/*" multiple onchange="newInput(this)"
                    id="inputImgMultiple">
                <button style="width: 50%; padding: 1rem !important;" type="button" onclick="removeAllImages()"
                    id="btnRemoveFile">
                    Remover todas as imagens</button>
                <ul id="dpFiles"></ul>

            @endif
            <div class="box-buttons">
                <button type="submit" class="btn-submit">Atualizar</button>
                <button type="button" class="btn-cancel"
                    onclick="window.location.href=`{{ route('page-listProdutos') }}`">Cancelar</button>
            </div>
            </form>
        @endif
    </main>

@endsection
