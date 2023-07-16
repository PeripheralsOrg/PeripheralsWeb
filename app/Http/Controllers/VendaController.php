<?php

namespace App\Http\Controllers;

use App\Models\CarrinhoCompras;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaTemporary;
use Illuminate\Http\Request;
use App\Models\ProdutoCarrinho;
use App\Models\ProdutoInventario;

class VendaController extends Controller
{
    public static function registerTemporary($valorTotal, $frete, $prazo, $quantItems, $idusers, $idCarrinho, $idEndereco)
    {
        $vendaT = new VendaTemporary();

        $vendaCreate = $vendaT->create([
            'valor_total' => $valorTotal,
            'frete' => floatval($frete),
            'prazo' => $prazo,
            'quantidade_items' => $quantItems,
            'id_users' => $idusers,
            'id_carrinho' => $idCarrinho,
            'id_endereco' => $idEndereco,

        ]);

        if ($vendaCreate) {
            return true;
        } else {
            return false;
        }
    }

    public function processVenda(Request $request)
    {
        $vendaT = new Venda();
        $getVenda = array_values(VendaTemporary::all()->where('id_carrinho', $request->idCarrinho)->toArray());
        $getCarinho = (CarrinhoCompras::all()->where('id_carrinho', $request->idCarrinho)->toQuery());


        // dd($getVenda);

        $vendaCreate = $vendaT->create([
            'valor_total' => $getVenda[0]['valor_total'],
            'frete' => $getVenda[0]['frete'],
            'valor_desconto_total' => 0.00,
            "quantidade_items" => $getVenda[0]['quantidade_items'],
            "id_users" => $request->session()->get('user')['id'],
            "id_carrinho" => $request->input('idCarrinho'),
            "id_endereco" => $getVenda[0]['id_endereco'],
            'id_venda_status' => 1
        ]);


        if ($vendaCreate) {
            $atualizarQuant = VendaController::atualizarQuantProduto($getCarinho);
            $getVenda = (VendaTemporary::all()->where('id_carrinho', $request->idCarrinho)->toQuery());
            $getVenda->delete();
            $getCarinho->update([
                'status' => 0
            ]);

            return redirect($request->input('checkoutLink'));
        } else {
            return redirect()->back()->withErrors('Ocorreu um erro ao finalizar a compra! Por favor contate o SAC');
        }
    }


    private static function atualizarQuantProduto($getCarinho)
    {
        $carrinhoProdutoS = array_values(ProdutoCarrinho::all()->where('id_carrinho', $getCarinho->getModel()->getAttribute('id_carrinho'))->toArray());

        $cart = ProdutoCarrinho::with('produto')->where('id_carrinho', $getCarinho->getModel()->getAttribute('id_carrinho'))
            ->whereHas('produto')->get()->pluck('produto')->toArray();

        function array_flatten($array)
        {
            return array_reduce($array, function ($carry, $item) {
                if (is_array($item)) {
                    return array_merge_recursive($carry, ($item));
                } else {
                    $carry[] = $item;
                    return $carry;
                }
            }, []);
        }

        $listProdutos = array_flatten($cart);


        for ($i = 0; $i < count($listProdutos); $i++) {
            $inventario = ProdutoInventario::all()->where('id_inventario', $listProdutos[$i]['id_inventario'])->toQuery();

            if(intval($inventario->getModel()->getAttribute('quantidade')) !== 0){
                $subtraction = intval($inventario->getModel()->getAttribute('quantidade')) - intval($carrinhoProdutoS[$i]['quantidade']);
                if($subtraction <= 0){
                    $inventario->update([
                        'quantidade' => 0,
                    ]);

                    $updateProd = Produto::all()->where('id_inventario', $listProdutos[$i]['id_inventario'])->toQuery();
                    $updateProd->update([
                        'status' => 0
                    ]);

                }else{
                    $inventario->update([
                        'quantidade' => $subtraction
                    ]);
                }
                
            }
            
        }
    }
}
