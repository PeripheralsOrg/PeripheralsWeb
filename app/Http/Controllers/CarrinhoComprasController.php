<?php

namespace App\Http\Controllers;

use App\Models\CarrinhoCompras;
use App\Models\Produto;
use App\Models\ProdutoCarrinho;

class CarrinhoComprasController extends Controller
{
    public function createCarrinho($idProduto, $quantidade, $iduser)
    {
        $getValueProduto = array_values(Produto::all()->where('id_produtos', $idProduto)->toArray())[0]['preco'];
        $valorTotal = $getValueProduto * $quantidade;
        $modelCarrinho = new CarrinhoCompras();

        return $modelCarrinho->create([
            'quant_items' => $quantidade,
            'status' => 1,
            'id_users' => $iduser,
            'valor_total' => $valorTotal
        ])->id_carrinho;
    }


    public function deleteCarrinho($idCarrinho){
        $deleteAll = CarrinhoCompras::findOrFail($idCarrinho);
        return $deleteAll->delete();
    }

    public function updateCarrinhoSoma($idCarrinho, $idProduto, $quantidade){
        $carrinhoItens = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();
        $checkProd = false;

        // Verificar Se produto já existe na tabela
        foreach($carrinhoItens as $itensSVerify){
            if($itensSVerify['id_produto'] == $idProduto){
                $checkProd = true;
            }
        }       

        if($checkProd){
            $getProdutoAtualizado = (new ProdutoCarrinhoController())->updateProdutoCarrinhoSoma($idProduto, $quantidade, $idCarrinho);
            if(!$getProdutoAtualizado){
                return false;
            }
            return $this->atualizarCarrinhoCompras($idCarrinho);

        }else{
            $insertNewProduto = (new ProdutoCarrinhoController())->insertProduto($idProduto, $quantidade, $idCarrinho);
            if (!$insertNewProduto) {
                return false;
            }
            return $this->atualizarCarrinhoCompras($idCarrinho);

        }


    }

    public function atualizarCarrinhoCompras($idCarrinho){
        $newCheckProdutos = ProdutoCarrinho::all()->where('id_carrinho', $idCarrinho)->toArray();
        $valoresProdutos = [];
        $quantidadeProdutos = [];
        foreach($newCheckProdutos as $produto){
            array_push($valoresProdutos, $produto['valor_total']);
            array_push($quantidadeProdutos, $produto['quantidade']);
        }

        $somaProdutoCarrinho = array_sum($valoresProdutos);
        $quantidadeProdutoCarrinho = array_sum($quantidadeProdutos);
        $modelCarrinho = CarrinhoCompras::find($idCarrinho);

        return $modelCarrinho->update([
            'valor_total' => $somaProdutoCarrinho,
            'quant_items' => $quantidadeProdutoCarrinho
        ]);
    }
}
