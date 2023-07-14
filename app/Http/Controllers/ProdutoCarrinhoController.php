<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoCarrinho;
use Illuminate\Http\Request;

class ProdutoCarrinhoController extends Controller
{

    public const VALOR_DESCONTO_DEFAULT = 0.00;

    public function insertProduto($idProduto, $quantidade, $idCarrinho)
    {
        $getValueProduto = array_values(Produto::all()->where('id_produtos', $idProduto)->toArray())[0]['preco'];
        $valorTotal = $getValueProduto * $quantidade;

        $modelProduto = new ProdutoCarrinho();

        return $modelProduto->create([
            'quantidade' => $quantidade,
            'valor_total' => $valorTotal,
            'valor_desconto' => ProdutoCarrinhoController::VALOR_DESCONTO_DEFAULT,
            'id_produto' => $idProduto,
            'id_carrinho' => $idCarrinho
        ]);
    }

    public function updateProdutoCarrinhoSoma($idProduto, $quantidade, $idCarrinho)
    {
        $updateProd = ProdutoCarrinho::all()->where('id_produto', $idProduto)->where('id_carrinho', $idCarrinho)->toQuery();
        $getValueProduto = array_values(Produto::all()->where('id_produtos', $idProduto)->toArray())[0]['preco'];
        $oldQuant = $updateProd->value('quantidade');

        return $updateProd->update([
            'quantidade' => ($oldQuant + $quantidade),
            'valor_total' => $getValueProduto * ($oldQuant + $quantidade)
        ]);
    }

    public function UpdateProdutoAll($idProduto, $quantidade, $idCarrinho)
    {
        $updateProd = ProdutoCarrinho::all()->where('id_produto', $idProduto)->where('id_carrinho', $idCarrinho)->toQuery();
        $getValueProduto = array_values(Produto::all()->where('id_produtos', $idProduto)->toArray())[0]['preco'];

        return $updateProd->update([
            'quantidade' => $quantidade,
            'valor_total' => ($getValueProduto * $quantidade)
        ]);
    }

    public function deleteItem($idProduto, $idCarrinho)
    {
        $deleteProd = ProdutoCarrinho::all()->where('id_produto', $idProduto)->where('id_carrinho', $idCarrinho)->toQuery();
        $execDelete = $deleteProd->delete();
        if ($execDelete) {
            return $execDelete;
        } else {
            return false;
        }
    }
}
