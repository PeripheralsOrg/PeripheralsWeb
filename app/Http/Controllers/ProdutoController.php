<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Validation\Rule;
use App\Http\Controllers\ProdutoImagensController;
use App\Http\Controllers\DetalhesProdutoController;
use App\Models\DetalhesProduto;
use App\Models\ProdutoInventario;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function all()
    {
        $produtos = Produto::all()->where('status', 1)->toArray();
        // $produtos = DB::select('SELECT * FROM view_produto WHERE status = 1');

        if ($produtos) {
            return view('admin.list.listProdutos')->with('produtos', $produtos);
        }
        return redirect()->route('falha-listProdutos');
    }

    public function fallback()
    {
        $erro = 'Produtos não encontrados!';
        return view('admin.list.listProdutos')->with('erro', $erro);
    }

    public function delete($id)
    {
        $produto = Produto::all()->where('id_produtos', $id)->toArray();

        $deleteDetalhes = (DetalhesProduto::all()->where('id_detalhes', $produto[$id - 1]['id_detalhes'])->toQuery())->update([
            'status' => 0
        ]);

        $deleteInventario = (ProdutoInventario::all()->where('id_inventario', $produto[$id - 1]['id_inventario'])->toQuery())->update([
            'status' => 0
        ]);

        if ($deleteDetalhes && $deleteInventario) {
            $deleteProduto = (Produto::all())->where('id_produtos', $id)->toQuery()->update([
                'status' => 0
            ]);

            if (!$deleteProduto) {
                return redirect()->back()->withErrors('Ocorreu um erro ao deletar o produto!');
            }

            return redirect()->back()->withErrors('Produto deletado com sucesso!');
        }

        return redirect()->back()->withErrors('Ocorreu um erro ao deletar o produto!');
    }

    public function register(Request $request)
    {

        // TODO: #34 Mudar mensagens de erro
        $validate = $request->validate([
            'codigo' => ['required', Rule::unique('users_detalhes_produto', 'codigo')],
            'nome' => ['required'],
            'preco' => ['required'],
            'modelo' => ['required'],
            'quantidade' => ['required'],
            'marca' => ['required'],
            'categoria' => ['required'],
            'descricao' => ['required'],
            'fonte_energia' => ['required'],
            'tamanho' => ['required'],
            'cor' => ['required'],
            'peso' => ['required'],
            'garantia' => ['required'],
            'is_promocao' => ['required'],
            'status' => ['required'],
        ]);

        $imagemPrincipal = $request->file('imagem_principal');
        $produtoModel = new Produto();

        $detalhesProduto = (new DetalhesProdutoController())->insertDetalhes(
            $request->except(
                'nome',
                'preco',
                'quantidade',
                'marca',
                'categoria',
                'descricao',
                'is_promocao',
                'modelo',
                '_token',
                'imagem_principal',
                'link_img'
            )
        );

        $inventarioProduto = (new ProdutoinventarioController())->insertInventario($request->input('quantidade'), $request->input('status'));

        $produtoC = $produtoModel->create([
            'nome' => $request->input('nome'),
            'preco' => str_replace(',', '.', $request->input('preco')),
            'modelo' => $request->input('modelo'),
            'marca' => $request->input('marca'),
            'descricao' => $request->input('descricao'),
            'status' => $request->input('status'),
            'is_promocao' => $request->input('is_promocao'),
            'id_detalhes' => intval($detalhesProduto),
            'id_inventario' => intval($inventarioProduto),
            'id_categoria' => $request->input('categoria')
        ])->id;

        if (!$produtoC) {
            return redirect()->back()->withErrors('Ocorreu um erro ao inserir o produto!');
        }

        if (empty($imagemPrincipal)) {
            return redirect()->back()->withErrors('Faça o upload da imagem principal!');
        }

        $pathImageP = $this->storeImages($imagemPrincipal, $request->input('nome'));
        if (!$pathImageP) {
            return redirect()->back()->withErrors('Ocorreu um erro ao realizar o upload da imagem!');
        }
        $pathNames = [];
        if (is_countable($request->file('link_img'))) {
            for ($i = 0; $i < count($request->file('link_img')); $i++) {
                $imagemStore = $request->file('link_img')[$i];
                $pathNames[$i] = $this->storeImages($imagemStore, $request->input('nome'), true, $i);
                if (!$pathNames[$i]) {
                    return redirect()->back()->withErrors('Ocorreu um erro ao realizar o upload da imagem!');
                }
            }
        }
        $produtoImagemP = (new ProdutoImagensController())->insertImage($pathImageP, $request->input('nome'), $produtoC);
        if (!empty($pathNames)) {
            $produtoImagens = (new ProdutoImagensController())->insertImage($pathNames, $request->input('nome'), $produtoC);
        }

        if ($produtoImagemP && $produtoImagens && $produtoC && $inventarioProduto && $detalhesProduto) {
            return redirect()->route('page-listProdutos');
        }
        return redirect()->back()->withErrors('Ocorreu um erro ao inserir as informações do produto!');
    }


    public function storeImages(HttpUploadedFile $file, $name, $array = false, $number = 0)
    {
        // TODO: #35 Criar campo principal na tabela de imagens de produtos
        //TODO: #36 Modificar a variável de nomeação
        //TODO: Criar nova constante de tamanho de imagem
        if (!$array) {
            if ($file->getMimeType() == 'image/png' || 'image/jpeg' || 'image/webp' || 'image/jpg') {
                if (!$file->isValid()) {
                    return back()->withErrors('O arquivo de imagem não é válido');
                }
                if ($file->getSize() > BannerController::MAXIMUM_SIZE) {
                    return back()->withErrors('O arquivo é grande demais');
                }
                $imageName = str_replace('/', '-', $file->getMimeType()) . '-' . date('Y-m-d') . '-' . $name . '.webp';
                return $file->storeAs('public/storage', $imageName);
            }
        } else {
            if ($file->getMimeType() == 'image/png' || 'image/jpeg' || 'image/webp' || 'image/jpg') {
                if (!$file->isValid()) {
                    return back()->withErrors('O arquivo de imagem não é válido');
                }

                if ($file->getSize() > BannerController::MAXIMUM_SIZE) {
                    return back()->withErrors('O arquivo é grande demais');
                }
                $imageName = str_replace('/', '-', $file->getMimeType()) . '-' . date('Y-m-d') . '-' . $name . '-' . $number . '.webp';
                return $file->storeAs('public/storage', $imageName);
            }
        }
    }
}
