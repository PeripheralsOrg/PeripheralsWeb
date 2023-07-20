<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoCarrinho;
use App\Models\VendaTemporary;
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
        $checkTemporaryVenda = array_values(VendaTemporary::all()->where('id_carrinho', $idCarrinho)->toArray());

        if($quantidade == 0 && count($checkTemporaryVenda) > 0){
            return (new CarrinhoComprasController())->deleteCarrinho($idCarrinho);
        }


        return $updateProd->update([
            'quantidade' => $quantidade,
            'valor_total' => ($getValueProduto * $quantidade)
        ]);
    }

    public function deleteItem($idProduto, $idCarrinho)
    {
        $deleteProd = ProdutoCarrinho::all()->where('id_produto', $idProduto)->where('id_carrinho', $idCarrinho)->toQuery();
        $checkTemporaryVenda = array_values(VendaTemporary::all()->where('id_carrinho', $idCarrinho)->toArray());

        if(count($checkTemporaryVenda) > 0){
            return (new CarrinhoComprasController())->deleteCarrinho($idCarrinho);
        }


        $execDelete = $deleteProd->delete();
        if ($execDelete) {
            return $execDelete;
        } else {
            return false;
        }
    }
}
